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
    <!-- google fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:it
al,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,1
00;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- google fonts -->
    <link rel="stylesheet" href="../css-bootstrap/bootstrap.min.css">
    <title>Projeto Minas</title>
</head>

<body class="animation">

    <?php include '../controller/cabecalho.php'; ?>

    <main>
        <section class="topo-do-site">

            <div class="interface">
                <div class="flex">
                    <div class="txt-topo-site">
                        <h1>Bem Vindo, Pequeno Explorador<span>!</span></h1>
                        <p>Ajudando você a indentificar espécies
                            mamíferas de Minas Gerais.</p>

                        <form action="index.php">
                            <div class="btn-contato">
                                <a href="#">
                                    <button>Identifique seu Animal !</button>
                                </a>
                            </div>
                        </form>

                    </div> <!-- txt-topo-site  -->
                    <div class=" img-topo-site ms-5">
                        <img src="../img/guaxinim.webp">
                    </div> <!-- ing topo site -->

                </div> <!-- flex -->
            </div> <!--interface -->
        </section> <!--topo do site -->
    </main>
    <?php include '../controller/carrossel.php'; ?>

    <main>
        <section class="body-card">
            <div class="container-cards">
                <div class="cards">
                    <span class="overlay"><div class="card-item"><img src="../img/image-removebg-preview.png" alt="imagem 1"></div></span>
                 
                    <h1>10</h1>
                    <p class="text-card">
                        Parques Ecológicos presentes na busca da I.A
                    </p>
                </div>

                <div class="cards">
                    <span class="overlay"><div class="card-item"><img src="../img/image-removebg-animal.png" alt="imagem 1"></div></span>
                    
                    <h1>50</h1>
                    <p class="text-card">
                     Mamíferos já presentes na busca da I.A
                    </p>
                </div>
            </div>

        </section>
    </main>

    <?php include '../controller/footer.php'; ?>
</body>

</html>