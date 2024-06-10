<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configurações de conexão com o banco de dados (substitua pelos seus próprios valores)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "crud";

    // Conecta ao banco de dados
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica se a conexão foi bem sucedida
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Obtém os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta SQL para verificar se o usuário existe
    $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuário autenticado, obtém o ID e armazena na sessão
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id_usuario'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['senha'] = $row['senha'];

        // Redireciona para a página de sucesso ou realiza alguma ação
        header("Location: ../view/Menu.php");
        exit();
    } else {
        // Usuário não encontrado, exibe uma mensagem de erro
        header("Location: login.php?login=erro");
        exit();
    }

    // Fecha a conexão
    $conn->close();
}
?>
