const tf = require("@tensorflow/tfjs-node");
const fs = require("fs");
const path = require("path");

// Carregar imagens e rótulos
function loadImagesAndLabels(datasetPath) {
  const categories = fs.readdirSync(datasetPath);
  const images = [];
  const labels = [];

  categories.forEach((category, index) => {
    const categoryPath = path.join(datasetPath, category);
    const imageFiles = fs.readdirSync(categoryPath);

    imageFiles.forEach((file) => {
      const filePath = path.join(categoryPath, file);
      const imageBuffer = fs.readFileSync(filePath);
      const decodedImage = tf.node.decodeImage(imageBuffer);

      images.push(decodedImage);
      labels.push(index); // Índice da categoria
    });
  });

  return { images, labels, categories };
}

// Treinar modelo
async function trainModel() {
  const datasetPath = path.join(__dirname, "../images/dataset");
  const { images, labels, categories } = loadImagesAndLabels(datasetPath);

  const xs = tf.stack(images.map(img => tf.image.resizeBilinear(img, [224, 224])).map(img => img.div(255)));
  const ys = tf.oneHot(labels, categories.length);

  const model = tf.sequential();
  model.add(tf.layers.conv2d({ inputShape: [224, 224, 3], filters: 32, kernelSize: 3, activation: "relu" }));
  model.add(tf.layers.maxPooling2d({ poolSize: [2, 2] }));
  model.add(tf.layers.flatten());
  model.add(tf.layers.dense({ units: 128, activation: "relu" }));
  model.add(tf.layers.dense({ units: categories.length, activation: "softmax" }));

  model.compile({ optimizer: "adam", loss: "categoricalCrossentropy", metrics: ["accuracy"] });

  await model.fit(xs, ys, { epochs: 10 });
  await model.save("file://backend/model");

  console.log("Modelo treinado e salvo!");
}

trainModel();
