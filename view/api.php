<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teachable Machine Image Model</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/super.css">
  <link rel="stylesheet" href="../css/API.css">
  <link rel="stylesheet" href="../css/style.css">
  <!-- google fonts  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:it
al,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,1
00;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- google fonts -->
  <link rel="stylesheet" href="../css-bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

  <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
</head>

<body>

  <?php include '../controller/cabecalho.php'; ?>

  <br>

  <input class="file" type="file" id="imagemSelecionada" accept="image/*" onchange="handleImageUpload(event)">

  <div id="image-container" style="text-align: center;">
    <br>
    <img id="imagemPreview" src="#" alt="Imagem selecionada">
  </div>


  <div class="btn-contato" style="text-align: center;">
    <br>
    <button type="button" onclick="analyze()">Analisar</button>
  </div>

  <div id="label-container"></div>

  <div id="animal-info"></div> <!-- Contêiner para as informações do animal -->

  <script type="text/javascript">
    const URL = "https://teachablemachine.withgoogle.com/models/4VJSfnPUq/";

    let model, labelContainer, maxPredictions;

    // Informações dos animais
    const animalInfo = {
      "jaguatirica": {
        peso: "7-15 kg",
        velocidade: "58 km/h",
        dieta: "Carnívoro",
        perigoso: "Sim",
        importancia_ecologica: "Controla populações de pequenos mamíferos e aves",
        reproducao: "Gestação de 70-85 dias, 1-3 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "10-15 anos (selvagem), 20 anos (cativeiro)",
        atividade: "Noturna",
        altura: "40-50 cm (ombro)",
        comprimento: "90-140 cm (incluindo cauda)"
      },

      "tamanduá-de-colete": {
        peso: "3-7 kg",
        velocidade: "48 km/h",
        dieta: "Carnívoro",
        perigoso: "Sim",
        importancia_ecologica: "Controla populações de insetos como cupins e formigas",
        reproducao: "Gestação de aproximadamente 190 dias, 1 filhote por vez",
        status_conservacao: "Vulnerável",
        tempoDeVida: "14 anos (cativeiro)",
        atividade: "Noturno e crepuscular",
        altura: "50-70 cm (ombro)",
        comprimento: "90-130 cm (incluindo cauda)"
      },

      "onça-parda": {
        peso: "25-80 kg",
        velocidade: "80 km/h",
        dieta: "Carnívoro",
        perigoso: "Sim",
        importancia_ecologica: "Predador de topo, regula populações de presas",
        reproducao: "Gestação de 90-96 dias, 1-6 filhotes",
        status_conservacao: "Quase ameaçado",
        tempoDeVida: "8-13 anos (selvagem), 20 anos (cativeiro)",
        atividade: "Crepuscular e noturna",
        altura: "60-75 cm (ombro)",
        comprimento: "1,5-2,4 m (incluindo cauda)"
      },

      "gato-mourisco": {
        peso: "5-8 kg",
        velocidade: "60 km/h",
        dieta: "Carnívoro",
        perigoso: "Sim",
        importancia_ecologica: "Controla populações de pequenos roedores e aves",
        reproducao: "Gestação de 63-66 dias, 1-4 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "13 anos (selvagem)",
        atividade: "Diurna e crepuscular",
        altura: "35-40 cm (ombro)",
        comprimento: "90-120 cm (incluindo cauda)"
      },

      "gato-do-mato": {
        peso: "2-5 kg",
        velocidade: "40 km/h",
        dieta: "Carnívoro",
        perigoso: "Sim",
        importancia_ecologica: "Controla populações de pequenos animais",
        reproducao: "Gestação de 70-78 dias, 1-3 filhotes",
        status_conservacao: "Quase ameaçado",
        tempoDeVida: "10 anos (selvagem)",
        atividade: "Noturna",
        altura: "30-40 cm (ombro)",
        comprimento: "65-90 cm (incluindo cauda)"
      },

      "lobo-guará": {
        peso: "20-30 kg",
        velocidade: "65 km/h",
        dieta: "Onívoro",
        perigoso: "Não",
        importancia_ecologica: "Dispersor de sementes e controlador de pequenos animais",
        reproducao: "Gestação de 60-65 dias, 2-6 filhotes",
        status_conservacao: "Quase ameaçado",
        tempoDeVida: "12-15 anos (selvagem)",
        atividade: "Crepuscular e noturna",
        altura: "75-90 cm (ombro)",
        comprimento: "1,2-1,3 m (incluindo cauda)"
      }
     
    };

    // Função para inicializar o modelo
    async function init() {
      try {
        const modelURL = URL + "model.json";
        const metadataURL = URL + "metadata.json";

        console.log("Carregando modelo...");
        model = await tmImage.load(modelURL, metadataURL);
        maxPredictions = model.getTotalClasses();
        console.log("Modelo carregado com sucesso:", model);

        labelContainer = document.getElementById("label-container");
        for (let i = 0; i < maxPredictions; i++) {
          labelContainer.appendChild(document.createElement("div"));
        }
      } catch (err) {
        console.error("Erro ao iniciar a aplicação:", err);
      }
    }

    // Função para lidar com o upload de imagem
    function handleImageUpload(event) {
      const file = event.target.files[0];
      const reader = new FileReader();

      reader.onload = function(event) {
        const imagemPreview = document.getElementById("imagemPreview");
        imagemPreview.src = event.target.result;
        console.log("Imagem carregada e exibida");

        const labelContainer = document.getElementById("label-container");
        labelContainer.innerHTML = "";
      };

      reader.readAsDataURL(file);
    }

    // Função para analisar a imagem
    async function analyze() {
      const imagemPreview = document.getElementById("imagemPreview");

      if (!imagemPreview.src || imagemPreview.src === "#") {
        alert("Por favor, carregue uma imagem primeiro.");
        return;
      }

      if (!model) {
        console.error("Modelo não carregado corretamente.");
        return;
      }

      console.log("Analisando imagem...");
      try {
        const prediction = await model.predict(imagemPreview);
        console.log("Previsões:", prediction);

        let maxProbability = -1;
        let maxClassIndex = -1;

        // Encontrar a classe com a maior probabilidade
        for (let i = 0; i < maxPredictions; i++) {
          if (prediction[i].probability > maxProbability) {
            maxProbability = prediction[i].probability;
            maxClassIndex = i;
          }
        }

        const labelContainer = document.getElementById("label-container");
        labelContainer.innerHTML = "";

        const className = prediction[maxClassIndex].className.trim().toLowerCase(); // Garantir que o nome seja consistente
        console.log("Classe identificada:", className); // Verifique qual classe foi identificada

        const probability = (prediction[maxClassIndex].probability * 100).toFixed(2);

        const predictionElement = document.createElement("div");
        predictionElement.classList.add("prediction");

        const text = `<span  class="class-name">${className}</span>: <span class="probability">${probability}%</span>`;
        predictionElement.innerHTML = text;

        labelContainer.appendChild(predictionElement);

        // Verificando e exibindo as características do animal identificado
        showAnimalInfo(className); // Usando o nome do animal com formatação consistente

      } catch (err) {
        console.error("Erro ao analisar a imagem:", err);
      }
    }

    // Função para mostrar as características do animal
    function showAnimalInfo(animalName) {
      const animalContainer = document.getElementById("animal-info");

      // Verificando se a chave existe no objeto animalInfo
      console.log("Verificando informações para:", animalName); // Verifique se o nome do animal é o esperado

      // Usando o nome em minúsculas para garantir que o nome do animal seja consistente
      if (animalInfo[animalName.toLowerCase()]) {
        const info = animalInfo[animalName.toLowerCase()];

        // Definindo a cor do frame com base na periculosidade do animal
        const frameColor = info.perigoso.toLowerCase() === "sim" ? "red" :"rgb(0, 197, 43)";


        const infoText = `	
          <div style = " border: 3px solid ${frameColor}; padding: 10px; margin: 55px; border-radius: 15px; background-color: ${frameColor}; color: white;">
          <h2 style="text-align: center;">${info.perigoso === "Sim" ? "ANIMAL POTENCIALMENTE PERIGOSO!" : "ANIMAL PACÍFICO"}</h2>

          <h3 style="text-align: center;">Características do(a) ${animalName.charAt(0).toUpperCase() + animalName.slice(1)}: </h3><br>
          <p><strong>Peso:</strong> ${info.peso}</p>  
          <p><strong>Velocidade:</strong> ${info.velocidade}</p>  
          <p><strong>Dieta:</strong> ${info.dieta}</p>  
          <p><strong>Perigoso:</strong> ${info.perigoso}</p>  
          <p><strong>Importância Ecológica:</strong> ${info.importancia_ecologica}</p>   
          <p><strong>Reprodução:</strong> ${info.reproducao}</p>      
          <p><strong>Status de Conservação:</strong> ${info.status_conservacao}</p>     
          <p><strong>Tempo de Vida:</strong> ${info.tempoDeVida}</p>  
          <p><strong>Atividade:</strong> ${info.atividade}</p>  
          <p><strong>Altura:</strong> ${info.altura}</p>  
          <p><strong>Comprimento:</strong> ${info.comprimento}</p>  
          </div>
  
          <br><br>
      
            <h4 style="text-align: center;">Mapa Habitacional</h4>
            <div style="text-align: center;">

        <div class="mapBox">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d6353.567831308609!2d-44.03189117239693!3d-20.061889259724108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sparque%20do%20rola%20mo%C3%A7a!5e1!3m2!1spt-BR!2sbr!4v1727891138046!5m2!1spt-BR!2sbr"
      width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>

    `;


        animalContainer.innerHTML = infoText;
      } else {
        animalContainer.innerHTML = "<p>Informações sobre este animal não estão disponíveis.</p>";
      }
    }

    window.onload = init;
  </script>


  <br>
</body>

</html>