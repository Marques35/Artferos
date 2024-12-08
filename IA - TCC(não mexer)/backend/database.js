const animals = {
    "Onça Parda": {
      name: "Onça Parda",
      description: "A onça-parda é um grande felino encontrado em florestas e montanhas.",
    },
    "Tamanduá Bandeira": {
      name: "Tamanduá Bandeira",
      description: "O tamanduá-bandeira é conhecido por sua longa língua e dieta de formigas.",
    },
  };
  
  function getAnimalData(name) {
    return animals[name] || { error: "Espécie não encontrada." };
  }
  
  module.exports = { getAnimalData };
  