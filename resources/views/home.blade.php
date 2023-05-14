@extends('layout')

@section('content')
@if (isset($error))
<p style="
    padding: 10px;
    color: red;
    font-weight: bold;
    font-size: 1.2rem;
">{{ $error }}</p>
@endif
<div class="form">
<h2><?php echo __('strings.register')  ?></h2>
<form method="POST" action=<?php
    $locale = app()->getLocale();
    echo "/$locale/register";
?>
>
  @csrf
  <div class="container">
    <div class="fields">
    <input type="text" name="full_name" placeholder="<?php echo __('strings.fullname')  ?>"
        value="{{ old('full_name') }}"
        @error('full_name') class="invalid" title="{{ $message }}" @enderror
        >
        <input type="text" name="username" placeholder="<?php echo __('strings.username')  ?>"
        value="{{ old('username') }}"
        @error('username') class="invalid" title="{{ $message }}" @enderror
        >
        <input type="email" name="email" placeholder="<?php echo __('strings.email')  ?>"
        value="{{ old('email') }}"
        @error('email') class="invalid" title="{{ $message }}" @enderror
        >
        <input type="password" name="password" placeholder="<?php echo __('strings.password')  ?>"
        @error('password') class="invalid" title="{{ $message }}" @enderror
        >
      <input type="password" name="confirm_password" placeholder="<?php echo __('strings.confirmpassword') ?>"
        @error('confirm_password') class="invalid" title="{{ $message }}" @enderror
        >
      <input type="date" name="birthdate" placeholder="<?php echo __('strings.birthdate') ?>"
        value="{{ old('birthdate') }}"
        @error('birthdate') class="invalid" title="{{ $message }}" @enderror
        >
        <input type="tel" name="phone" placeholder="<?php echo __('strings.phone') ?>"
        value="{{ old('phone') }}"
        @error('phone') class="invalid" title="{{ $message }}" @enderror
        >
        <input type="text" name="address" placeholder="<?php echo __('strings.address') ?>"
        value="{{ old('address') }}"
        @error('address') class="invalid" title="{{ $message }}" @enderror
        >
    </div>
    <div class="side">
    <h3><?php echo __('strings.actors') ?>:</h3>
      <div class="actors">
        <div class="loading"></div>
      </div>
    </div>
</div>
<button type="submit"><?php echo __('strings.register') ?></button>
</form>
<script>
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            input.classList.remove('invalid');
        });
    });

    document
      .querySelector('input[name="birthdate"]')
      .addEventListener("blur", getActors);

    function getnconst(actor) {
        // actor = "/name/nm0000001/"
        // nconst = "nm0000001"
        return actor.substring(6, actor.length - 1);
    }

    function getActors() {
      // Get the actors container
      const actorsContainer = document.querySelector(".actors");

      // Clear the actors container
      actorsContainer.innerHTML = "";

      const newLoading = document.createElement("div");
      newLoading.classList.add("loading");
      newLoading.style.display = "block";
      actorsContainer.append(newLoading);

      // Get the birthdate field
      const birthdate = document.querySelector('input[name="birthdate"]');
      // Get the birthdate value
      const birthdateValue = birthdate.value;
      // Get the month and day (format: YYYY-MM-DD)
      const month = birthdateValue.substring(5, 7);
      const day = birthdateValue.substring(8, 10);

      // Check if the birthdate field is empty
      if (birthdateValue == "") {
        newLoading.style.display = "none";
        return;
      }

      // Get the actors using an AJAX request to api.php
      const request = new XMLHttpRequest();
      const url = `https://online-movie-database.p.rapidapi.com/actors/list-born-today?month=${month}&day=${day}`
      const API_KEY = "b56036c2a9msh8e3d79214b6ac0fp1f0aa1jsn81d4de64253b";
      request.open("GET", url);
      request.setRequestHeader("X-RapidAPI-Host", "online-movie-database.p.rapidapi.com");
      request.setRequestHeader("X-RapidAPI-Key", API_KEY);
      request.onload = function () {
        newLoading.style.display = "none";
        // Parse the JSON response
        const actors = JSON.parse(request.responseText);

        // Loop through the actors
        for (let i = 0; i < 5; i++) {
          // Make another AJAX request to get the actor bio
          const request2 = new XMLHttpRequest();
          const url2 = `https://online-movie-database.p.rapidapi.com/actors/get-bio?nconst=${getnconst(actors[i])}`;

          request2.open("GET", url2);
          request2.setRequestHeader("X-RapidAPI-Host", "online-movie-database.p.rapidapi.com");
          request2.setRequestHeader("X-RapidAPI-Key", API_KEY);

          request2.onload = function () {
            // Parse the JSON response
            const actorRes = JSON.parse(request2.responseText);
            console.log(actorRes);

            // Create the actor div
            const actor = document.createElement("div");
            actor.classList.add("actor");

            // Create the actor image
            const actorImage = document.createElement("img");
            actorImage.src = actorRes.image.url;
            actorImage.alt = "Actor image";

            // Create the actor name
            const actorName = document.createElement("p");
            actorName.textContent = actorRes.name;

            // Append the actor image and name to the actor div
            actor.appendChild(actorImage);
            actor.appendChild(actorName);

            // Append the actor div to the actors container
            actorsContainer.appendChild(actor);
          };
          request2.send();
        }
      };

      request.send();
    }
</script>
</div>
@endsection
