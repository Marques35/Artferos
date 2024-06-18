<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/super.css">
    <title>Image Recognition with Clarifai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        #results {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include '../controller/cabecalho.php';?>
    <h1>Reconhecimento de imagem com Clarifai</h1>
    <form id="imageForm">
        <input type="file" id="imageInput" accept="image/*">
        <input type="text" id="imageUrl" placeholder="Ou insira uma URL da imagem">
        <button type="submit">Análise de imagem</button>
    </form>
    <div id="results"></div>

    <!-- Include the Clarifai JavaScript library from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/clarifai@latest/dist/clarifai.min.js"></script>
    <!-- Link to the external JavaScript file -->
    <script src="script.js"></script>
</body>
</html>
