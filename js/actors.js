// Add an event listener to the birthdate field
document
  .querySelector('input[name="birthdate"]')
  .addEventListener("blur", getActors);

function getActors() {
  // Get the actors container
  const actorsContainer = document.querySelector(".actors");

  // Clear the actors container
  actorsContainer.innerHTML = "";

  const newLoading = document.createElement("div");
  newLoading.classList.add("loading");
  newLoading.style.visibility = "visible";
  actorsContainer.append(newLoading);

  // Get the birthdate field
  const birthdate = document.querySelector('input[name="birthdate"]');
  // Get the birthdate value
  const birthdateValue = birthdate.value;
  // Get the month and day (format: YYYY-MM-DD)
  const month = birthdateValue.substring(5, 7);
  const day = birthdateValue.substring(8, 10);

  // Get the actors using an AJAX request to api.php
  const request = new XMLHttpRequest();
  request.open("GET", "api.php?month=" + month + "&day=" + day);
  request.onload = function () {
    // Parse the JSON response
    const response = JSON.parse(request.responseText);
    // Get the actors list
    const actors = response.actors;

    // Loop through the actors
    for (let i = 0; i < actors.length; i++) {
      // Create the actor div
      const actor = document.createElement("div");
      actor.classList.add("actor");

      // Create the actor image
      const actorImage = document.createElement("img");
      actorImage.src = actors[i].image;
      actorImage.alt = "Actor image";

      // Create the actor name
      const actorName = document.createElement("p");
      actorName.textContent = actors[i].name;

      // Append the actor image and name to the actor div
      actor.appendChild(actorImage);
      actor.appendChild(actorName);

      // Append the actor div to the actors container
      actorsContainer.appendChild(actor);
    }
  };

  request.send();
}
