<?php
include "./api/config/database.php";

// insert data to database
if ($_GET["action"] === "insertData") {
  if (!empty($_POST["name"]) && !empty($_POST["age"]) && !empty($_POST["phone"]) && !empty($_POST["address"]) && !empty($_POST["email"]) && !empty($_POST["user_type"])) {
    
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $age = mysqli_real_escape_string($conn, $_POST["age"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $user_type = mysqli_real_escape_string($conn, $_POST["user_type"]);

    $sql = "INSERT INTO `users`(`id`, `name`, `age`, `phone`, `address`, `email`, `user_type`) VALUES (NULL,'$name','$age','$phone','$address','$email','$user_type')";
      
    if (mysqli_query($conn, $sql)) {

      echo json_encode([
          "statusCode" => 200,
          "message" => "Successfully added a User!"
      ]);
      } else {

          echo json_encode([
              "statusCode" => 500,
              "message" => "Failed to add User"
          ]);
      }
    } else {

      echo json_encode([
          "statusCode" => 400,
          "message" => "Please fill all the required fields"
      ]);
    }
}