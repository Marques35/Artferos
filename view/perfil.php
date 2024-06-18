<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}

// Configurações de conexão com o banco de dados (substitua pelos seus próprios valores)
$servername = "localhost";
$username = "root";
$password = "";
$database = "crud";

try {
    // Cria uma nova conexão PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Configura o modo de erro para exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtém o ID do usuário da sessão
    $user_id = $_SESSION['user_id'];

    // Busca os dados do usuário logado
    $stmt = $conn->prepare("SELECT nome, email, senha FROM usuarios WHERE id_usuario = :id");
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Atualiza os dados da sessão
    $_SESSION['nome'] = $user['nome'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['senha'] = $user['senha'];
} catch (PDOException $e) {
    // Em caso de erro, exibe uma mensagem de erro
    echo "Erro ao buscar dados: " . $e->getMessage();
}

// Fecha a conexão
$conn = null;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/super.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css-bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Projeto Minas</title>
</head>

<body>

    <?php include '../controller/cabecalho.php'; ?>

    <main>
        <section>
            <div class="container">
              
                </div>
                <div class="form">
                    <div class="form-header">
                        <div class="title">
                            <h1>Meu perfil</h1>
                        </div>
                    </div>
                    <form id="profileForm" action="../models/modificar.php" method="POST">       
                            <input class="" id="nome" type="text" name="nome" value="<?php echo $_SESSION['nome']; ?>" disabled>
                            <br><br>
                            <input id="email" type="email" name="email" value="<?php echo $_SESSION['email']; ?>" disabled>
                            <br><br>
                            <input id="senha" type="password" name="password" value="<?php echo $_SESSION['senha']; ?>" disabled>
                            <i class="bi bi-eye-fill" id="btn-senha" onclick="mostrarSenha()"></i>
                            <br><br><br>
                            <button class="btn btn-danger" type="button" onclick="deleteAccount()">Deletar</button>
                            <button class="btn btn-primary" type="button" onclick="enableEditing()">Editar</button>
                            <button class="btn btn-success" type="submit">Salvar</button>
                    </form>
                    <form id="deleteForm" action="../models/deletar.php" method="POST" style="display:none;">
                        <input type="hidden" name="delete" value="1">
                    </form>
                </div>
            </div>
        </section>
        <br>
    </main>
<<<<<<< HEAD
    <?php include '../controller/footer.php';?>
    
=======
    

>>>>>>> d294e8da5fe5c1fffd4a72f9b6690718f76a4afd
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function enableEditing() {
            document.getElementById('nome').disabled = false;
            document.getElementById('email').disabled = false;
            document.getElementById('senha').disabled = false;
        }

        function deleteAccount() {
            if (confirm('Tem certeza de que deseja deletar sua conta?')) {
                document.getElementById('deleteForm').submit();
            }
        }

        function togglePasswordVisibility() {
            var senhaField = document.getElementById("senha");
            if (senhaField.type === "password") {
                senhaField.type = "text";
            } else {
                senhaField.type = "password";
            }
        }
    </script>

    <script src="mostrarSenha.js"></script>

<<<<<<< HEAD
    
=======
    <?php include '../controller/footer.php'; ?>
>>>>>>> 2eb6ec2488e63a548840b0d43698a3befaa9cf96
</body>
   



</html>

