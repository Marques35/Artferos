<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/super.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <!-- google fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:it
al,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,1
00;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- google fonts -->
    <link rel="stylesheet" href="../css-bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <title>Artferos</title>
</head>

<body class="animation">

    <?php include '../controller/cabecalho.php'; ?>

    <main  data-aos="fade-left">
        <section class="topo-do-site">

            <div class="interface">
                <div class="flex">
                    <div class="txt-topo-site">
                        <h1>Bem Vindo, Pequeno Explorador<span>!</span></h1>
                        <p>Ajudando você a indentificar espécies
                            mamíferas de Minas Gerais.</p>

                        <form action="api.html">
                            <div class="btn-contato">
                                <button>Identifique seu Animal !</button>
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

    <main data-aos="fade-left">
        <section class="body-card">
            <div class="container-cards">

                <div class="cards">
                    <div class="card-item"><img src="../img/image-removebg-preview.png" alt="imagem 1"></div>
                    <p class="text-card">
                    <h1>10</h1> Parques Ecológicos presentes na busca da I.A
                    </p>
                </div>

                <div class="cards">
                    <div class="card-item"><img src="../img/image-removebg-animal.png" alt="imagem 1"></div>
                    <p class="text-card">
                    <h1>50</h1>
                    Mamíferos já presentes na busca da I.A
                    </p>
                </div>
            </div>

        </section>
    </main>

    <main class="function" id="como funciona">
      
            <div class="title-container"    data-aos="fade-up">
                <h1 class="title-function">Como Funciona:</h1>
            </div>
            <div class="content-function"    data-aos="fade-up">
                <div class="texto">
                    <p>Nosso site utiliza inteligência artificial para identificar animais a partir de imagens. Siga esses passos simples:</p>
                    <ol>
                        <li>1. Acesse a opção "Identifique seu animal".</li>
                        <li>2. Envie uma foto do animal que deseja identificar.</li>
                        <li>3. Nossa IA analisará a imagem e fornecerá rapidamente a identificação do animal.</li>
                    </ol>
                    <p>Simples assim! Experimente agora e descubra qual animal você encontrou.</p>

    </main>


    <main>
        <?php include '../controller/sobrenos.html'; ?>
    </main><br>


    <footer id="footer-contato">
        <div class="container-footer">
            <div class="row-footer">
                <!-- footer col-->
                <div class="footer-col">
                    <h4>Artferos</h4>
                    <ul>
                        <li><a href="#inicio"> Início</a></li>
                        <li><a href="#sobre-nos"> Sobre Nós </a></li>
                        <li><a href="#como funciona">  Como Funciona ?</a></li>
                        <li><a href=""> política de privacidade</a></li>
                    </ul>
                </div>
                <!--end footer col-->
                <!-- footer col-->
                <div class="footer-col">
                    <h4>Contato</h4>
                    <ul>
                        <li>artferos@gmail.com</li>
                        <li>(31) 9 9999999</li>
                        <li>Brasil - Minas Gerais</li>
                    </ul>
                </div>
                <!--end footer col-->
                <!-- footer col-->
                <div class="footer-col">
                 
                </div>
                <!--end footer col-->
                <!-- footer col-->
                <div class="footer-col">
                    <h4>Se subescreva!</h4>
                    <div class="form-sub">
                        <form>
                            <input type="email" placeholder="Digite o seu e-mail" required>
                            <button>subscrever</button>
                        </form>
                    </div>

                    <div class="medias-socias">
                        <a href="https://www.instagram.com/projetominass/?utm_source=ig_web_button_share_sheet"> <i class="fa fa-instagram"></i> </a>
                        <a href="#"> <i class="fa fa-github"></i> </a>
                    </div>

                </div>
                <!--end footer col-->
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>