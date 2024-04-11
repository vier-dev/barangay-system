<?php
include "./api/config/database.php";

// function to fetch data
if ($_GET["action"] === "fetchData") {
  $sql = "SELECT * FROM users";
  $result = mysqli_query($conn, $sql);
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  mysqli_close($conn);
  header('Content-Type: application/json');
  echo json_encode([
    "data" => $data
  ]);
}

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



// fetch data of individual user for edit form
if ($_GET["action"] === "fetchSingle") {
  $id = $_POST["id"];
  $sql = "SELECT * FROM users WHERE `id`=$id";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    header("Content-Type: application/json");
    echo json_encode([
      "statusCode" => 200,
      "data" => $data
    ]);
  } else {
    echo json_encode([
      "statusCode" => 404,
      "message" => "No user found with this id"
    ]);
  }
  mysqli_close($conn);
}



// function to update data
if ($_GET["action"] === "updateData") {

    // get id from hidden field in form
    $id = $_POST["id"];

    // check whether record exists or not
    if (!empty($_POST["name"]) && !empty($_POST["age"]) && !empty($_POST["phone"]) && !empty($_POST["address"]) && !empty($_POST["email"]) && !empty($_POST["user_type"])) {
  
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $age = mysqli_real_escape_string($conn, $_POST["age"]);
        $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
        $address = mysqli_real_escape_string($conn, $_POST["address"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $user_type = mysqli_real_escape_string($conn, $_POST["user_type"]);

      $sql = "UPDATE users SET `name`='$name',`age`='$age',`phone`='$phone',`address`='$address',`email`='$email',`user_type`='$user_type' WHERE `id`=$id";
      
      if (mysqli_query($conn, $sql)) {
        echo json_encode([
          "statusCode" => 200,
          "message" => "Data updated successfully"
        ]);
      } else {
        echo json_encode([
          "statusCode" => 500,
          "message" => "Failed to update data"
        ]);
      }
      mysqli_close($conn);
    } else {
      echo json_encode([
        "statusCode" => 400,
        "message" => "Please fill all the required fields"
      ]);
    }
}



// function to delete data
if ($_GET["action"] === "deleteData") {

  $id = $_POST["id"];

  $sql = "DELETE FROM users WHERE `id`=$id";

  if (mysqli_query($conn, $sql)) {
    echo json_encode([
      "statusCode" => 200,
      "message" => "Data deleted successfully"
    ]);
  } else {
    echo json_encode([
      "statusCode" => 500,
      "message" => "Failed to delete data"
    ]);
  }
}