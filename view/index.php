<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/super.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- google fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:it
al,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,1
00;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- google fonts -->
    <link rel="stylesheet" href="../css-bootstrap/bootstrap.min.css">
    <title>Image Recognition with Clarifai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        
    </style>
</head>
<body>
<<<<<<< HEAD
   <?php include '../controller/cabecalho.php'; ?>
=======
    <?php include '../controller/cabecalho.php';?>
>>>>>>> 2eb6ec2488e63a548840b0d43698a3befaa9cf96
    <h1>Reconhecimento de imagem com Clarifai</h1>
    <form id="imageForm">
        <input type="file" id="imageInput" accept="image/*">
        <input type="text" id="imageUrl" placeholder="Ou insira uma URL da imagem">
        <button type="submit">Análise de imagem</button>
    </form>
    <div id="results"></div>

    <?php include '../controller/footer.php'; ?>

    <!-- Include the Clarifai JavaScript library from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/clarifai@latest/dist/clarifai.min.js"></script>
    <!-- Link to the external JavaScript file -->
    <script src="script.js"></script>
</body>
</html>
