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
        nivel_de_seguranca: "Parcialmente seguro",
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
        nivel_de_seguranca: "Parcialmente seguro",
        nivel_de_seguranca: "Parcialmente seguro",
        importancia_ecologica: "Controla populações de insetos como cupins e formigas",
        reproducao: "Gestação de aproximadamente 190 dias, 1 filhote por vez",
        status_conservacao: "Vulnerável",
        tempoDeVida: "14 anos (cativeiro)",
        atividade: "Noturno e crepuscular",
        altura: "50-70 cm (ombro)",
        comprimento: "90-130 cm (incluindo cauda)"
      },

      "onça parda": {
        peso: "25-80 kg",
        velocidade: "80 km/h",
        dieta: "Carnívoro",
        nivel_de_seguranca: "Perigoso",
        nivel_de_seguranca: "Perigoso",
        importancia_ecologica: "Predador de topo, regula populações de presas",
        reproducao: "Gestação de 90-96 dias, 1-6 filhotes",
        status_conservacao: "Quase ameaçado",
        tempoDeVida: "8-13 anos (selvagem), 20 anos (cativeiro)",
        atividade: "Crepuscular e noturna",
        altura: "60-75 cm (ombro)",
        comprimento: "1,5-2,4 m (incluindo cauda)"
      },

      "gato mourisco": {
        peso: "5-8 kg",
        velocidade: "60 km/h",
        dieta: "Carnívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Controla populações de pequenos roedores e aves",
        reproducao: "Gestação de 63-66 dias, 1-4 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "13 anos (selvagem)",
        atividade: "Diurna e crepuscular",
        altura: "35-40 cm (ombro)",
        comprimento: "90-120 cm (incluindo cauda)"
      },

      "gato do mato": {
        peso: "2-5 kg",
        velocidade: "40 km/h",
        dieta: "Carnívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
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
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Dispersor de sementes e controlador de pequenos animais",
        reproducao: "Gestação de 60-65 dias, 2-6 filhotes",
        status_conservacao: "Quase ameaçado",
        tempoDeVida: "12-15 anos (selvagem)",
        atividade: "Crepuscular e noturna",
        altura: "75-90 cm (ombro)",
        comprimento: "1,2-1,3 m (incluindo cauda)"
      },

      "raposa do campo": {
        peso: "3-5 kg",
        velocidade: "40 km/h",
        dieta: "Onívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Dispersor de sementes e controlador de populações de pequenos animais",
        reproducao: "Gestação de 50-60 dias, 2-5 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "11-13 anos (selvagem)",
        atividade: "Crepuscular e noturna",
        altura: "35-40 cm (ombro)",
        comprimento: "65-85 cm (incluindo cauda)"
      },

      "mão-pelada": {
        peso: "4-8 kg",
        velocidade: "15-20 km/h",
        dieta: "Onívoro",
        nivel_de_seguranca: "Perigoso",
        nivel_de_seguranca: "Perigoso",
        importancia_ecologica: "Auxilia no controle de pequenos animais e na dispersão de sementes",
        reproducao: "Gestação de 63-65 dias, 2-6 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "12-15 anos (selvagem)",
        atividade: "Noturna",
        altura: "20-30 cm (ombro)",
        comprimento: "50-70 cm (incluindo cauda)"
      },

      "coati": {
        peso: "4-7 kg",
        velocidade: "25-30 km/h",
        dieta: "Onívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Dispersor de sementes e controlador de populações de insetos",
        reproducao: "Gestação de 75-80 dias, 2-7 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "7-8 anos (selvagem)",
        atividade: "Diurna",
        altura: "25-30 cm (ombro)",
        comprimento: "85-110 cm (incluindo cauda)"
      },

      "irara": {
        peso: "5-7 kg",
        velocidade: "25-30 km/h",
        dieta: "Onívoro",
        nivel_de_seguranca: "Perigoso",
        nivel_de_seguranca: "Perigoso",
        importancia_ecologica: "Controlador de populações de pequenos animais e insetos",
        reproducao: "Gestação de 63-65 dias, 1-3 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "12-15 anos (selvagem)",
        atividade: "Diurna e crepuscular",
        altura: "20-30 cm (ombro)",
        comprimento: "90-110 cm (incluindo cauda)"
      },

      "lontra": {
        peso: "7-12 kg",
        velocidade: "10-12 km/h (em terra), 6-8 km/h (na água)",
        dieta: "Carnívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Indicador de qualidade ambiental e controlador de populações de peixes",
        reproducao: "Gestação de 60-70 dias, 1-3 filhotes",
        status_conservacao: "Quase ameaçado",
        tempoDeVida: "10-15 anos (selvagem)",
        atividade: "Diurna e crepuscular",
        altura: "25-30 cm (ombro)",
        comprimento: "1-1,2 m (incluindo cauda)"
      },

      "ouriço": {
        peso: "0,8-1,5 kg",
        velocidade: "2-4 km/h",
        dieta: "Herbívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Dispersor de sementes",
        reproducao: "Gestação de 34-49 dias, 1-2 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "5-7 anos (selvagem)",
        atividade: "Noturna",
        altura: "10-15 cm (ombro)",
        comprimento: "20-30 cm (incluindo espinhos)"
      },

      "preá": {
        peso: "0,7-1,2 kg",
        velocidade: "25-30 km/h",
        dieta: "Herbívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Dispersor de sementes e parte da cadeia alimentar",
        reproducao: "Gestação de 59-72 dias, 1-3 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "4-8 anos (selvagem)",
        atividade: "Diurna",
        altura: "10-15 cm (ombro)",
        comprimento: "20-40 cm"
      },

      "tatu peba": {
        peso: "3-6 kg",
        velocidade: "20-25 km/h",
        dieta: "Onívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Aerador do solo e controlador de populações de insetos",
        reproducao: "Gestação de 120 dias, 1-3 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "12-15 anos (selvagem)",
        atividade: "Noturna",
        altura: "15-20 cm (ombro)",
        comprimento: "40-60 cm (incluindo cauda)"
      },

      "tatu-galinha": {
        peso: "5-10 kg",
        velocidade: "30-35 km/h",
        dieta: "Onívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Aerador do solo e dispersor de sementes",
        reproducao: "Gestação de 120 dias, 1-4 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "10-15 anos (selvagem)",
        atividade: "Noturna",
        altura: "20-30 cm (ombro)",
        comprimento: "50-70 cm (incluindo cauda)"
      },

      "caititus": {
        peso: "20-30 kg",
        velocidade: "35-40 km/h",
        dieta: "Onívoro",
        nivel_de_seguranca: "Parcialmente seguro",
        nivel_de_seguranca: "Parcialmente seguro",
        importancia_ecologica: "Dispersor de sementes",
        reproducao: "Gestação de 140-150 dias, 2-4 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "9-10 anos (selvagem)",
        atividade: "Diurna e crepuscular",
        altura: "40-50 cm (ombro)",
        comprimento: "90-100 cm"
      },

      "veado catingueiro": {
        peso: "20-25 kg",
        velocidade: "40-50 km/h",
        dieta: "Herbívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Dispersor de sementes",
        reproducao: "Gestação de 200-220 dias, 1 filhote",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "10-12 anos (selvagem)",
        atividade: "Crepuscular e noturna",
        altura: "60-70 cm (ombro)",
        comprimento: "100-120 cm"
      },

      "furão pequeno": {
        peso: "0,5-1 kg",
        velocidade: "15-20 km/h",
        dieta: "Carnívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Controlador de populações de pequenos animais",
        reproducao: "Gestação de 40-42 dias, 2-4 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "6-8 anos (selvagem)",
        atividade: "Noturna",
        altura: "10-15 cm (ombro)",
        comprimento: "30-45 cm (incluindo cauda)"
      },

      "capivara": {
        peso: "35-65 kg",
        velocidade: "25-30 km/h",
        dieta: "Herbívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Dispersor de sementes e parte da cadeia alimentar",
        reproducao: "Gestação de 150 dias, 3-8 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "8-10 anos (selvagem)",
        atividade: "Diurna",
        altura: "50-60 cm (ombro)",
        comprimento: "100-130 cm"
      },

      "paca": {
        peso: "6-12 kg",
        velocidade: "20-25 km/h",
        dieta: "Herbívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Dispersor de sementes",
        reproducao: "Gestação de 115-120 dias, 1-2 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "13-15 anos (selvagem)",
        atividade: "Noturna",
        altura: "25-30 cm (ombro)",
        comprimento: "60-80 cm"
      },

      "cutia": {
        peso: "2-3 kg",
        velocidade: "35-40 km/h",
        dieta: "Herbívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Dispersor de sementes",
        reproducao: "Gestação de 104-120 dias, 2-4 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "7-8 anos (selvagem)",
        atividade: "Diurna",
        altura: "25-30 cm (ombro)",
        comprimento: "45-60 cm"
      },

      "tamanduá bandeira": {
        peso: "30-45 kg",
        velocidade: "10-15 km/h",
        dieta: "Insetívoro",
        nivel_de_seguranca: "Parcialmente seguro",
        nivel_de_seguranca: "Parcialmente seguro",
        importancia_ecologica: "Controlador de populações de insetos",
        reproducao: "Gestação de 190-195 dias, 1 filhote",
        status_conservacao: "Vulnerável",
        tempoDeVida: "14-16 anos (selvagem)",
        atividade: "Diurna e crepuscular",
        altura: "60-90 cm (ombro)",
        comprimento: "1,8-2,1 m (incluindo cauda)"
      },

      "tapeti": {
        peso: "0,8-1,3 kg",
        velocidade: "40-50 km/h",
        dieta: "Herbívoro",
        nivel_de_segurança: "Seguro",
        nivel_de_segurança: "Seguro",
        importancia_ecologica: "Dispersor de sementes e parte da cadeia alimentar",
        reproducao: "Gestação de 28-32 dias, 1-5 filhotes",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "3-5 anos (selvagem)",
        atividade: "Crepuscular e noturna",
        altura: "20-25 cm (ombro)",
        comprimento: "30-45 cm"
      },

      "preguiça de garganta marrom": {
        peso: "4-6 kg",
        velocidade: "0,2-0,5 km/h",
        dieta: "Herbívoro",
        nivel_de_seguranca: "Parcialmente seguro",
        nivel_de_seguranca: "Parcialmente seguro",
        importancia_ecologica: "Dispersor de sementes",
        reproducao: "Gestação de 180 dias, 1 filhote",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "20-30 anos (selvagem)",
        atividade: "Diurna",
        altura: "35-50 cm (ombro)",
        comprimento: "50-70 cm"
      },

      "preguiça de coleira": {
        peso: "4-9 kg",
        velocidade: "0,3-0,6 km/h",
        dieta: "Herbívoro",
        nivel_de_seguranca: "Parcialmente seguro",
        nivel_de_seguranca: "Parcialmente seguro",
        importancia_ecologica: "Dispersor de sementes",
        reproducao: "Gestação de 180-210 dias, 1 filhote",
        status_conservacao: "Vulnerável",
        tempoDeVida: "20-30 anos (selvagem)",
        atividade: "Diurna",
        altura: "35-50 cm (ombro)",
        comprimento: "50-80 cm"
      },

      "sagui da serra escuro": {
        peso: "0,3-0,4 kg",
        velocidade: "20-25 km/h",
        dieta: "Onívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Dispersor de sementes e controlador de insetos",
        reproducao: "Gestação de 140-150 dias, 2-3 filhotes",
        status_conservacao: "Vulnerável",
        tempoDeVida: "10-12 anos (selvagem)",
        atividade: "Diurna",
        altura: "15-20 cm (ombro)",
        comprimento: "30-40 cm (incluindo cauda)"
      },

      "mico leão dourado": {
        peso: "0,5-0,7 kg",
        velocidade: "20-25 km/h",
        dieta: "Onívoro",
        nivel_de_seguranca: "Seguro",
        nivel_de_seguranca: "Seguro",
        importancia_ecologica: "Dispersor de sementes e controlador de insetos",
        reproducao: "Gestação de 126-132 dias, 1-3 filhotes",
        status_conservacao: "Em perigo",
        tempoDeVida: "15 anos (selvagem)",
        atividade: "Diurna",
        altura: "20-25 cm (ombro)",
        comprimento: "50-60 cm (incluindo cauda)"
      },

      "bugio ruivo": {
        peso: "6-8 kg",
        velocidade: "30-35 km/h",
        dieta: "Herbívoro",
        nivel_de_seguranca: "Parcialmente seguro",
        nivel_de_seguranca: "Parcialmente seguro",
        importancia_ecologica: "Dispersor de sementes",
        reproducao: "Gestação de 186-194 dias, 1 filhote",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "15-20 anos (selvagem)",
        atividade: "Diurna",
        altura: "40-50 cm (ombro)",
        comprimento: "50-70 cm (excluindo cauda)"
      },

      "bugio preto": {
        peso: "6-9 kg",
        velocidade: "30-35 km/h",
        dieta: "Herbívoro",
        nivel_de_seguranca: "Parcialmente seguro",
        nivel_de_seguranca: "Parcialmente seguro",
        importancia_ecologica: "Dispersor de sementes",
        reproducao: "Gestação de 186-194 dias, 1 filhote",
        status_conservacao: "Pouco preocupante",
        tempoDeVida: "15-20 anos (selvagem)",
        atividade: "Diurna",
        altura: "40-50 cm (ombro)",
        comprimento: "50-70 cm (excluindo cauda)"
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
        console.error("Modelo Seguro carregado corretamente.");
        console.error("Modelo Seguro carregado corretamente.");
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


        

        // Verificando o nível de segurança e ajustando a cor e texto correspondentes
        let frameColor;
        let titleText;

        if (info.nivel_de_seguranca.toLowerCase() === "perigoso") {
          frameColor = "red";
          titleText = "ANIMAL POTENCIALMENTE PERIGOSO!";
        } else if (info.nivel_de_seguranca.toLowerCase() === "parcialmente seguro") {
          frameColor = "rgb(255, 196, 0)";
          titleText = "ANIMAL PARCIALMENTE PERIGOSO!";
        } else {
          frameColor = "rgb(0, 197, 43)";
          titleText = "ANIMAL PACÍFICO";
        }

        const infoText = `
  <div style="border: 3px solid ${frameColor}; padding: 10px; margin: 55px; border-radius: 25px; background-color: ${frameColor}; color: white;">
    <h2 style="text-align: center;">${titleText}</h2>
    <h3 style="text-align: center;">Características do(a) ${animalName.charAt(0).toUpperCase() + animalName.slice(1)}: </h3><br>
    <p><strong>Peso:</strong> ${info.peso}</p>  
    <p><strong>Velocidade:</strong> ${info.velocidade}</p>  
    <p><strong>Dieta:</strong> ${info.dieta}</p>  
    <p><strong>Nível de Segurança:</strong> ${info.nivel_de_seguranca}</p>  
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
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>

    `;

        animalContainer.innerHTML = infoText;

      } else if (!animalInfo[animalName.toLowerCase()] || animalName.toLowerCase().trim() === "não tem nada"){
        animalContainer.innerHTML = "<p>Informações sobre este animal Seguro estão disponíveis.</p>";
        animalContainer.innerHTML = `
      <div style="border: 3px solid gray; padding: 20px; margin: 55px; margin-top: 5px; border-radius: 25px; background-color: lightgray; color: black;">
        <h2 style="text-align: center;">Nenhum animal foi identificado !</h2>
        <p style="text-align: center;">Por favor, envie uma imagem com maior qualidade ou certifique-se de que há um animal na foto.</p>
      </div>`;
          return;
      }
    }



    window.onload = init;
  </script>


  <br>
</body>

</html>