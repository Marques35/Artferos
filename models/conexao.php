<?php
// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configurações de conexão com o banco de dados (substitua pelos seus próprios valores)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "crud";

    try {
        
        // Conecta ao banco de dados usando PDO
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // Define o modo de erro do PDO como exceção
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara a instrução SQL para inserir os dados
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");

     
        // Bind dos parâmetros
        $stmt->bindParam(':nome', ($_POST['usuario']));
        $stmt->bindParam(':email',($_POST['email']));
        $stmt->bindParam(':senha', ($_POST['senha']));

        // Executa a instrução preparada
        $stmt->execute();

        header("Location: ../view/login.php?cadastro=success");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }

    // Fecha a conexão
    $conn = null;
} else {
    // Se o método de requisição não for POST, redireciona para a página de formulário
    header("Location: ../view/cadastro.php");
    exit();
}
?>