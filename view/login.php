

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stylecadastro.css">
    <title>Login Artferos</title>


</head>

<body>
    <div>
        <form action="../models/logar.php" method="POST">
            <img src="../img/artferos.png" width="130">
            <h1>Login</h1>
            <input type="text" name="email" id="email" placeholder="Email" required>
            <br><br>
            <input type="password" name="senha" id="senha" placeholder="Senha" required>
            <br><br><br>
            <button class="Entrar" type="submit" id="submitBtn">Entrar</button>
            <br><br>
            <p>Não tem cadastro? <a href="cadastro.php">Crie agora!</a></p>
        </form>
    </div>
    </div>


</body>

</html>