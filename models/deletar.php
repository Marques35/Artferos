<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "crud";

    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();

        session_destroy();
        header("Location: ../view/cadastro.php?deletado=success");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao deletar conta: " . $e->getMessage();
    }

    $conn = null;
}
?>
