document.querySelectorAll("input").forEach(function (input) {
  input.addEventListener("keyup", function () {
    input.classList.remove("invalid");
  });
});

document
  .querySelector('input[type="file"]')
  .addEventListener("change", function (e) {
    document.querySelector(".image").classList.remove("invalid");
  });
