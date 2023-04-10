<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // echo post data
  echo print_r($_POST, true);

  // Make sure all fields exist
  // check them one by one to provide clear error messages
  if (!isset($_POST['full_name']) || empty($_POST['full_name'])) {
    die('Full name is required');
  }
  if (!isset($_POST['username']) || empty($_POST['username'])) {
    die('Username is required');
  }
  if (!isset($_POST['email']) || empty($_POST['email'])) {
    die('Email is required');
  }
  if (!isset($_POST['password']) || empty($_POST['password'])) {
    die('Password is required');
  }
  if (!isset($_POST['birthdate']) || empty($_POST['birthdate'])) {
    die('Birthdate is required');
  }
  if (!isset($_POST['phone']) || empty($_POST['phone'])) {
    die('Phone is required');
  }
  if (!isset($_POST['address']) || empty($_POST['address'])) {
    die('Address is required');
  }

  // Make sure all fields are valid, check them one by one to provide clear error messages

  // Make sure email is valid
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    die('Email is invalid');
  }

  // Make sure password is at least 8 characters with at least 1 number literal and 1 special character
  // without using regex
  $password = $_POST['password'];
  if (strlen($password) < 8) {
    die('Password must be at least 8 characters');
  }

  $has_number = false;
  $has_special_character = false;

  // Check each character in the password if it's a number or a special character
  for ($i = 0; $i < strlen($password); $i++) {
    // The is_numeric() function checks whether a variable is a number or a numeric string.
    if (is_numeric($password[$i])) {
      $has_number = true;
    }
    // The ctype_alnum() function checks for alphanumeric character(s).
    if (!ctype_alnum($password[$i])) {
      $has_special_character = true;
    }
  }

  // Make sure the password has at least 1 number literal and 1 special character
  if (!$has_number || !$has_special_character) {
    die('Password must contain at least 1 number literal and 1 special character');
  }

  // Make sure a file was uploaded and it's an image (field name is user_image)
  if (!isset($_FILES['user_image']) || $_FILES['user_image']['error'] !== UPLOAD_ERR_OK) {
    die('Image is required');
  }

  // Make sure the file is an image (jpeg, png, jpg)
  $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
  if (!in_array($_FILES['user_image']['type'], $allowed_types)) {
    die('Image must be a jpeg, png or jpg');
  }

  include __DIR__ . '/db.php';

  $database = new Database();

  // Save the user data in the database
  $full_name = $_POST['full_name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $birthdate = $_POST['birthdate'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  // Make sure the username is unique
  if ($database->user_exists($username)) {
    die('Username already exists');
  }

  die('Success');
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
  <link rel="stylesheet" href="css/validations.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <script src="js/theme-switcher.js" defer></script>
  <script src="js/imageUpload.js" defer></script>
  <script src="js/submit.js" defer></script>
  <script src="js/validations.js" defer></script>
</head>

<body>
  <?php include "header.php" ?>
  <div class="wrapper">
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
            <input type="file" name="user_image">
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
  </div>
  <?php include "footer.php" ?>
</body>

</html>