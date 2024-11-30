<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "crud";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_SESSION['user_id'];
        $sql = "UPDATE usuarios SET ";
        $params = [];

        if (!empty($_POST['nome'])) {
            $nome = $_POST['nome'];
            $sql .= "nome=:nome, ";
            $params[':nome'] = $nome;
        }

        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            $sql .= "email=:email, ";
            $params[':email'] = $email;
        }

        if (!empty($_POST['password'])) {
            $senha = $_POST['password'];
            $sql .= "senha=:senha, ";
            $params[':senha'] = $senha;
        }

        $sql = rtrim($sql, ", ");
        $sql .= " WHERE id_usuario=:id";
        $params[':id'] = $user_id;

        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        if (!empty($nome)) {
            $_SESSION['nome'] = $nome;
        }
        if (!empty($email)) {
            $_SESSION['email'] = $email;
        }
        if (!empty($_POST['password'])) {
            $_SESSION['senha'] = $_POST['password'];
        }

        header("Location: ../view/perfil.php?modificacao=success");
        exit();
    } else {
        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("SELECT nome, email, senha FROM usuarios WHERE id_usuario = :id");
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['nome'] = $user['nome'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['senha'] = $user['senha'];
    }
} catch (PDOException $e) {
    echo "Erro ao buscar dados: " . $e->getMessage();
}

$conn = null;
?>
