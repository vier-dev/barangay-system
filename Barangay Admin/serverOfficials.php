<?php
include "./api/config/database.php";

// function to fetch data
if ($_GET["action"] === "fetchData") {
  $sql = "SELECT * FROM `officials` WHERE `position` NOT LIKE '%Barangay Captain%';";
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
    if (!empty($_POST['name']) && !empty($_POST['gender']) && !empty($_POST['birthday']) && !empty($_POST['address']) &&!empty($_POST['position']) && !empty($_POST['description']) && $_FILES["image"]["size"] != 0) {
    
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $birthday = mysqli_real_escape_string($conn, $_POST["birthday"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $position = mysqli_real_escape_string($conn, $_POST["position"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]); 

    $imageName = $_FILES["image"]["name"];
    $imageNewName = uniqid() . time() . "." . pathinfo($imageName, PATHINFO_EXTENSION);
    move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $imageNewName);

    $sql = "INSERT INTO `officials`(`official_id`, `name`, `gender`, `birthday`, `address`, `position`, `description`, `image`) 
    VALUES (NULL,'$name','$gender','$birthday','$address','$position','$description','$imageNewName')";
      
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

  // get id from hidden field in form
  $id = $_POST["id"];

  $sql = "SELECT * FROM `officials` WHERE `official_id`=$id";

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
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    // check whether record exists or not
    if (!empty($_POST['name']) && !empty($_POST['gender']) && !empty($_POST['birthday']) && !empty($_POST['address']) &&!empty($_POST['position']) && !empty($_POST['description'])) {
    
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
        $birthday = mysqli_real_escape_string($conn, $_POST["birthday"]);
        $address = mysqli_real_escape_string($conn, $_POST["address"]);
        $position = mysqli_real_escape_string($conn, $_POST["position"]);
        $description = mysqli_real_escape_string($conn, $_POST["description"]);     

      if ($_FILES["image"]["size"] != 0) {

        // rename the image before saving to database
        $imageName = $_FILES["image"]["name"];
        $imageNewName = uniqid() . time() . "." . pathinfo($imageName, PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $imageNewName);

        // remove the old image from uploads directory
        unlink("uploads/" . $_POST["image_old"]);

      } else {

        $imageNewName = mysqli_real_escape_string($conn, $_POST["image_old"]);

      }
    
      $sql = "UPDATE `officials` SET `name`='$name',`gender`='$gender',`birthday`='$birthday',`address`='$address',`position`='$position',`description`='$description', `image`='$imageNewName' WHERE `official_id`=$id";
    
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

   // get id from hidden field in form
   $id = $_POST["id"];
   $delete_image = $_POST["delete_image"];

  $sql = "DELETE FROM `officials` WHERE `official_id`=$id";

  if (mysqli_query($conn, $sql)) {

    // remove the image
    unlink("uploads/" . $delete_image);

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



//for brgy captain
// function to fetch data
if ($_GET["action"] === "fetchCaptain") {

  $sql = "SELECT * FROM `officials` WHERE `position`='Barangay Captain'";
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
if ($_GET["action"] === "insertCaptain") {
    if (!empty($_POST['name']) && !empty($_POST['gender']) && !empty($_POST['birthday']) && !empty($_POST['address']) && $_FILES["image"]["size"] != 0) {
    
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $birthday = mysqli_real_escape_string($conn, $_POST["birthday"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $position = mysqli_real_escape_string($conn, $_POST["position"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);

    $imageName = $_FILES["image"]["name"];
    $imageNewName = uniqid() . time() . "." . pathinfo($imageName, PATHINFO_EXTENSION);
    move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $imageNewName);

    $sql = "INSERT INTO `officials`(`official_id`, `name`, `gender`, `birthday`, `address`, `position`, `description`, `image`) 
    VALUES (NULL,'$name','$gender','$birthday','$address','$position','$description','$imageNewName')";
      
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

