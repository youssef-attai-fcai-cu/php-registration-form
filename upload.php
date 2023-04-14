<?php

function uploadImage($image)
{
  // Directory to upload files to
  $target_dir = __DIR__ . '/' . 'uploads/';

  // Get the file name and extension
  $target_file = $target_dir . $image;
  $imageFileType = strtolower(pathinfo($_FILES['user_image']['name'], PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if (isset($_POST["submit"])) {
    try {
      $check = getimagesize($_FILES["user_image"]["tmp_name"]);
      if ($check == false) {
        die("File is not an image.");
      }
    } catch (ValueError $th) {
      die("Something went wrong.");
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
      die("Sorry, only JPG, JPEG, PNG files are allowed.");
    }

    if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
      echo "The file " . htmlspecialchars(basename($_FILES["user_image"]["name"])) . " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}
