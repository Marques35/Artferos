<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stylecadastro.css">
    <title>Cadastro Projeto Minas</title>
</head>
<body>
    <div>
        <img src="../img/artferos.png" width="130">
        <h1>Cadastro</h1>
        <form action="../models/conexao.php" method="POST">
            <input type="text" name="usuario" id="usuario" placeholder="Digite seu nome" required>
            <br><br>
            <input type="text" name="email" id="email" placeholder="Digite seu Email" required>
            <br><br>
            <input type="password" name="senha" id="senha" placeholder="Crie uma Senha" required>
            <br><br><br>
            <button type="submit">Cadastrar</button>
        </form>

        
        <br><br>
        <form action="../view/login.php">
        <p>Já possui uma conta? <a href="login.php">Faça login aqui!</a></p>
        </form>
        
    </div>
</body>
</html>
