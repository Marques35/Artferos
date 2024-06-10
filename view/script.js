const PAT = '3cec9e9cd133470683c57d9c8180f057';
const USER_ID = 'clarifai';
const APP_ID = 'main';
const MODEL_ID = 'general-image-recognition-vit';
const MODEL_VERSION_ID = '1bf8b41a7c154eaca6203643ff6a75b6';

document.getElementById('imageForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const imageInput = document.getElementById('imageInput').files[0];
    const imageUrl = document.getElementById('imageUrl').value;
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = 'Analisando imagem...';

    if (imageInput) {
        const reader = new FileReader();
        reader.onloadend = function() {
            const base64Image = reader.result.split(',')[1];
            analyzeImage({base64: base64Image});
        }
        reader.readAsDataURL(imageInput);
    } else if (imageUrl) {
        analyzeImage({url: imageUrl});
    } else {
        resultsDiv.innerHTML = 'Por favor, carregue uma imagem ou insira uma URL.';
    }
});

function analyzeImage(imageData) {
    const raw = JSON.stringify({
        "user_app_id": {
            "user_id": USER_ID,
            "app_id": APP_ID
        },
        "inputs": [
            {
                "data": {
                    "image": imageData
                }
            }
        ]
    });

    const requestOptions = {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Key ' + PAT
        },
        body: raw
    };

    fetch("https://api.clarifai.com/v2/models/" + MODEL_ID + "/versions/" + MODEL_VERSION_ID + "/outputs", requestOptions)
        .then(response => response.json())
        .then(result => {
            displayResults(result);
        })
        .catch(error => {
            document.getElementById('results').innerHTML = 'Erro: ' + error;
        });
}

function displayResults(result) {
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = '<h2>Resultados:</h2>';
    const concepts = result.outputs[0].data.concepts;
    concepts.forEach(concept => {
        const conceptElement = document.createElement('p');
        conceptElement.textContent = `${concept.name}: ${concept.value.toFixed(2)}`;
        resultsDiv.appendChild(conceptElement);
    });
}
