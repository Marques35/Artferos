document.addEventListener("DOMContentLoaded", function() {
    const slideBoxList = document.querySelectorAll(".slide-box");
    const radioBtnList = document.querySelectorAll("[name='btn-radio']");
    const autoBtnList = document.querySelectorAll(".auto-btn");
  
    let currentIndex = 0;
    let intervalId;
  
    // Função para exibir o slide atual
    function showSlide(index) {
      // Ocultar todos os slides
      slideBoxList.forEach((slideBox) => {
        slideBox.style.marginLeft = `-${index * 100}%`;
      });
    }
  
    // Função para avançar para o próximo slide
    function nextSlide() {
      currentIndex = (currentIndex + 1) % slideBoxList.length;
      showSlide(currentIndex);
      updateRadioBtn();
    }
  
    // Função para atualizar o botão de rádio correspondente ao slide atual
    function updateRadioBtn() {
      radioBtnList.forEach((radioBtn, index) => {
        radioBtn.checked = index === currentIndex;
      });
    }
  
    // Adicionar evento de clique aos botões de navegação automática
    autoBtnList.forEach((autoBtn, index) => {
      autoBtn.addEventListener("click", () => {
        currentIndex = index;
        showSlide(currentIndex);
        updateRadioBtn();
        clearInterval(intervalId);
        // Iniciar a navegação automática novamente após 5 segundos
        intervalId = setInterval(nextSlide, 5000);
      });
    });
  
    // Iniciar a navegação automática
    intervalId = setInterval(nextSlide, 5000);
  });
  