document.querySelector(".image").addEventListener("click", function () {
  document.querySelector('input[type="file"]').click();
});

const currentImage = document.querySelector("img");

function setCurrentSelection(selected) {
  const reader = new FileReader();
  reader.onloadend = function () {
    currentImage.src = reader.result;
    document.querySelector(".no-image").style.display = "none";
  };

  reader.readAsDataURL(selected);
}

document
  .querySelector("input[type=file]")
  .addEventListener("change", function (e) {
    const selected = e.target.files[0];

    if (
      selected !== undefined &&
      e.target.value !== "" &&
      (selected.type == "image/jpg" ||
        selected.type == "image/jpeg" ||
        selected.type == "image/png")
    ) {
      setCurrentSelection(selected);
    } else {
      currentImage.src = "";
      document.querySelector(".no-image").style.display = "flex";
    }
  });
