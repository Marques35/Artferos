const express = require("express");
const multer = require("multer");
const tf = require("@tensorflow/tfjs-node");
const path = require("path");
const fs = require("fs");
const { getAnimalData } = require("./database");

const app = express();
const PORT = 3000;

// Configuração de upload de imagens
const upload = multer({ dest: path.join(__dirname, "../images/user-uploads") });

// Carregar modelo de IA
let model;
(async () => {
  model = await tf.loadLayersModel("file://backend/model/model.json");
})();

// Rota para identificação de imagens
app.post("/api/identify", upload.single("image"), async (req, res) => {
  try {
    const filePath = req.file.path;

    // Processar imagem
    const imageBuffer = fs.readFileSync(filePath);
    const decodedImage = tf.node.decodeImage(imageBuffer);
    const resizedImage = tf.image.resizeBilinear(decodedImage, [224, 224]);
    const inputTensor = resizedImage.expandDims(0).div(255);

    // Predição
    const prediction = model.predict(inputTensor);
    const predictedClass = prediction.argMax(-1).dataSync()[0];

    // Mapear predição para espécie
    const species = ["Onça Parda", "Tamanduá Bandeira"];
    const animal = getAnimalData(species[predictedClass]);

    // Limpeza do arquivo temporário
    fs.unlinkSync(filePath);

    // Retornar dados
    res.json(animal);
  } catch (error) {
    console.error(error);
    res.status(500).json({ error: "Erro na análise da imagem." });
  }
});

// Iniciar servidor
app.listen(PORT, () => console.log(`Servidor rodando em http://localhost:${PORT}`));
