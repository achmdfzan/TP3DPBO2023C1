<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Game.php');
include('classes/Template.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $targetDir = "assets/images/"; // Directory where you want to save the uploaded images
  $targetFile = $targetDir . basename($_FILES["foto"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

  // Check if the image file is a actual image or fake image
  $check = getimagesize($_FILES["foto"]["tmp_name"]);
  if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["foto"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow only certain file formats
  if (
    $imageFileType != "jpg" &&
    $imageFileType != "jpeg" &&
    $imageFileType != "png" &&
    $imageFileType != "gif"
  ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  } else {
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
      echo "The file " . basename($_FILES["foto"]["name"]) . " has been uploaded.";
      
      $foto = $_FILES["foto"]["name"];
      $nama = $_POST["nama"];
      $genre = $_POST["genre"];
      $platform = $_POST["platform"];
      $developer = $_POST["developer"];
      $publisher = $_POST["publisher"];
      
      $game = new Game($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
      $game->open();
      $game->addData($foto, $nama, $genre, $platform, $developer, $publisher);

      header("Location: index.php");
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
}
}
