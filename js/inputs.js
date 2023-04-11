document.querySelectorAll("input").forEach(function (input) {
  input.addEventListener("keyup", function () {
    input.classList.remove("invalid");
  });
});

document
  .querySelector('input[type="file"]')
  .addEventListener("change", function () {
    document.querySelector(".image").classList.remove("invalid");
  });

// remove invalid class from birthdate upon change
document
  .querySelector('input[name="birthdate"]')
  .addEventListener("change", function () {
    document
      .querySelector('input[name="birthdate"]')
      .classList.remove("invalid");
  });
