const form = document.getElementById("uploadForm");

form.addEventListener("submit", async (event) => {
  event.preventDefault();
  
  const fileInput = document.getElementById("imageUpload");
  const formData = new FormData();
  formData.append("image", fileInput.files[0]);

  const response = await fetch("http://localhost:3000/api/identify", {
    method: "POST",
    body: formData,
  });

  const result = await response.json();
  const resultDiv = document.getElementById("result");
  if (result.error) {
    resultDiv.textContent = `Erro: ${result.error}`;
  } else {
    resultDiv.textContent = `Animal: ${result.name}\nDescrição: ${result.description}`;
  }
});
