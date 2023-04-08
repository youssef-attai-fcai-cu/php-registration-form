// Initialize variables to store the current file and preview image
var currentFile = null;
var preview = document.querySelector("img");

document
  .querySelector("input[type=file]")
  .addEventListener("change", function () {
    var file = document.querySelector("input[type=file]").files[0];

    if (file) {
      // Store the selected file in the currentFile variable
      currentFile = file;

      if (
        file.type === "image/jpeg" ||
        file.type === "image/png" ||
        file.type === "image/jpg"
      ) {
        var reader = new FileReader();

        reader.onloadend = function () {
          preview.src = reader.result;
          document.querySelector(".no-image").style.display = "none";
        };

        reader.readAsDataURL(file);
      } else {
        preview.src = "";
        document.querySelector(".no-image").style.display = "flex";
      }
    }
  });

document.querySelector(".image").addEventListener("click", function () {
  // Trigger the file input element click event
  document.querySelector("input[type=file]").click();
});

// Store the original preview image source in a data attribute
preview.dataset.originalSrc = preview.src;
