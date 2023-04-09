<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Make sure all fields exist
  if (
    isset(
      $_POST['full_name'],
      $_POST['username'],
      $_POST['email'],
      $_POST['password'],
      $_POST['confirm_password'],
      $_POST['birthdate'],
      $_POST['phone'],
      $_POST['address'],
      $_POST['user_image']
    ) && !empty($_POST['full_name'])
    && !empty($_POST['username'])
    && !empty($_POST['email'])
    && !empty($_POST['password'])
    && !empty($_POST['confirm_password'])
    && !empty($_POST['birthdate'])
    && !empty($_POST['phone'])
    && !empty($_POST['address'])
    && !empty($_POST['user_image'])
  ) {
    echo "All fields exist";
  } else {
    echo "Missing fields";
  }
  die();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Out Website</title>
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/form.css">
  <script src="js/imageUpload.js" defer></script>
</head>

<body>
  <?php include "header.php" ?>
  <div class="form">
    <h2>Register</h2>
    <div class="container">
      <div class="fields">
        <input type="text" name="full_name" placeholder="Full name">
        <input type="text" name="username" placeholder="Username">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirm_password" placeholder="Confirm password">
        <input type="text" name="birthdate" placeholder="Birthdate" onfocus="(this.type='date')" onblur="(this.type='text')">
        <input type="tel" name="phone" placeholder="Phone">
        <input type="text" name="address" placeholder="Address">
      </div>
      <div class="side">
        <div class="image">
          <input type="file" name="user_image" id="file-upload">
          <img src="" height="200" alt="User image preview">
          <div class="no-image">
            <div class="icon upload-icon"></div>
            <p>Upload an image</p>
          </div>
        </div>
        <h3>Actors born on the same day:</h3>
        <div class="actors"></div>
        <button type="submit">Register</button>
      </div>
    </div>
  </div>
  <?php include "footer.php" ?>
</body>

</html>