<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>Footer Responsivo</title>
</head>

<body>
    <footer id="footer-contato">
        <div class="container-footer">
            <div class="row-footer">
                <!-- footer col-->
                <div class="footer-col">
                    <h4>Artferos</h4>
                    <ul>
                        <li><a href="#inicio"> Início</a></li>
                        <li><a href="#sobre-nos"> Sobre Nós </a></li>
                        <li><a href="#como funciona"> Como Funciona ?</a></li>
                        
                    </ul>
                </div>
                <!--end footer col-->
                <!-- footer col-->
                <div class="footer-col">
                    <h4>Contato</h4>
                    <ul>
                        <li>artferos@gmail.com</li>
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
                        <form id="subscribe-form">
                            <input type="email" name="email" placeholder="Digite o seu e-mail" required>
                            <button type="submit">subscrever</button>
                        </form>
                    </div>



                </div>
                <!--end footer col-->
            </div>
        </div>
    </footer>

    <!-- Script do EmailJS -->
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

    <script>
        // Inicializar o EmailJS
        emailjs.init("7Ko4xcALv76UMUztU"); // Substitua pela sua Public Key

        // Configurar o envio do formulário
        document.getElementById("subscribe-form").addEventListener("submit", (e) => {
            e.preventDefault(); // Evita o reload da página

            // Captura o e-mail do formulário
            const emailInput = e.target.email.value;

            // Verifica se o e-mail foi preenchido
            if (!emailInput) {
                alert("Por favor, insira um e-mail válido.");
                return;
            }

            // Parâmetros do e-mail (substitua os valores pela sua configuração no EmailJS)
            const serviceID = "service_ot3z7vt"; // Substitua pelo seu Service ID
            const templateID = "template_xokk6cm"; // Substitua pelo seu Template ID

            // Envia o e-mail usando o EmailJS
            emailjs.send(serviceID, templateID, {
                    user_email: emailInput, // Parâmetro do e-mail
                })
                .then(() => {
                    alert("Inscrição realizada com sucesso! Verifique seu e-mail.");
                })
                .catch((error) => {
                    console.error("Erro ao enviar o e-mail:", error);
                    alert("Houve um problema. Tente novamente.");
                });
        });
    </script>


</body>

</html>