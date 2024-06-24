<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/landingpage.css">
    <link rel="stylesheet" href="../css/super.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css-bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Landing-Page</title>
</head>

<body>
    <?php include '../controller/cabecalho-page.php'; ?>

    <section>
    <div class="carousel"  data-aos="fade-right">
    <div class="list">
            <div class="item">
                <div class="content"   >
                    <div class="author">Projeto Minas</div>
                    <div class="title">DESCUBRA SEU</div>
                    <div class="topic">ANIMAL</div>
                    <div class="des">
                        <!-- lorem 50 -->
                        O Projeto Minas visa promover o reconhecimento e a preservação dos animais nos parques de preservação de Minas Gerais através de imagens. O mesmo permite a identificação de diversas espécies de mamíferos que habitam esses parques. Oferecemos uma plataforma educativa para aumentar a conscientização sobre a importância da fauna local. Junte-se a nós nessa missão de proteger a rica biodiversidade de Minas Gerais e contribuir para a sustentabilidade dos ecossistemas naturais.
                    </div><br>
                    <form action="cadastro.php">
                            <div class="btn-contato-page">
                                <button>Cadastre-se</button>
                            </div>
                        </form>
                </div>
            </div>
    </div>
    </div>
    </section>
    <?php include '../controller/footer.php'; ?>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>