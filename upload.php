<?php

function uploadImage()
{
  // Directory to upload files to
  $target_dir = "uploads/";

  // Get the file name and extension
  $target_file = $target_dir . basename($_FILES["user_image"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  $uploadOk = 1;

  // Check if image file is a actual image or fake image
  if (isset($_POST["submit"])) {
    try {
      $check = getimagesize($_FILES["user_image"]["tmp_name"]);
      if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    } catch (ValueError $th) {
      $uploadOk = 0;
    }
  }

  // Allow certain file formats
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG, JPEG, PNG files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
      echo "The file " . htmlspecialchars(basename($_FILES["user_image"]["name"])) . " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}
