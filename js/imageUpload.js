document
  .querySelector("input[type=file]")
  .addEventListener("change", function () {
    var preview = document.querySelector("img");
    var file = document.querySelector("input[type=file]").files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
      preview.src = reader.result;
      document.querySelector(".no-image").style.display = "none";
    };

    if (file) {
      if (file.type === "image/jpeg" || file.type === "image/png" || file.type === "image/jpg") {
        reader.readAsDataURL(file);
      } else {
        preview.src = "";
        document.querySelector(".no-image").style.display = "flex";
      }
    } else {
      preview.src = "";
      document.querySelector(".no-image").style.display = "flex";
    }
  });

document.querySelector(".image").addEventListener("click", function () {
  document.querySelector("input[type=file]").click();
});
