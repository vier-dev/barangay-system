<?php
include "./api/config/database.php";

// function to fetch data
if ($_GET["action"] === "fetchData") {
  $sql = "SELECT * FROM `blotter` WHERE blotter_status='Active'";

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
    if (!empty($_POST['defendant']) && !empty($_POST['complainant']) && !empty($_POST['status']) && !empty($_POST['incident_date']) &&!empty($_POST['accusation']) &&!empty($_POST['date_file'])) {
    
    $defendant = mysqli_real_escape_string($conn, $_POST["defendant"]);
    $complainant = mysqli_real_escape_string($conn, $_POST["complainant"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);
    $incident_date = mysqli_real_escape_string($conn, $_POST["incident_date"]);
    $accusation = mysqli_real_escape_string($conn, $_POST["accusation"]);
    $date_file = mysqli_real_escape_string($conn, $_POST["date_file"]);

    $sql = "INSERT INTO `blotter`(`blotter_id`, `defendant`, `complainant`, `blotter_status`, `incident_date`, `blotter_accusation`, `date_filed`) 
    VALUES (NULL,'$defendant','$complainant','$status', '$incident_date', '$accusation', '$date_file')";
      
    if (mysqli_query($conn, $sql)) {

      echo json_encode([
          "statusCode" => 200,
          "message" => "Successfully added a Blotter!"
      ]);
      } else {

          echo json_encode([
              "statusCode" => 500,
              "message" => "Failed to add a Blotter Information"
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

  $sql = "SELECT * FROM `blotter` WHERE `blotter_id`=$id";

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
      "message" => "No data found with this id"
    ]);
  }
  mysqli_close($conn);
}


// function to update data
if ($_GET["action"] === "updateData") {
    
    // get id from hidden field in form
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    // check whether record exists or not
    if (!empty($_POST['defendant']) && !empty($_POST['complainant']) && !empty($_POST['status']) && !empty($_POST['incident_date']) &&!empty($_POST['accusation']) &&!empty($_POST['date_file'])) {
    
      $defendant = mysqli_real_escape_string($conn, $_POST["defendant"]);
      $complainant = mysqli_real_escape_string($conn, $_POST["complainant"]);
      $status = mysqli_real_escape_string($conn, $_POST["status"]);
      $incident_date = mysqli_real_escape_string($conn, $_POST["incident_date"]);
      $accusation = mysqli_real_escape_string($conn, $_POST["accusation"]);
      $date_file = mysqli_real_escape_string($conn, $_POST["date_file"]);

      $sql = "UPDATE `blotter` SET `defendant`='$defendant',`complainant`='$complainant',`blotter_accusation`='$accusation',`incident_date`='$incident_date',`blotter_status`='$status' ,`date_filed`='$date_file' WHERE `blotter_id`=$id";
    
      if (mysqli_query($conn, $sql)) {
        echo json_encode([
          "statusCode" => 200,
          "message" => "Blotter Information updated successfully"
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
  $id = mysqli_real_escape_string($conn, $_POST["id"]);

  $sql = "DELETE FROM `blotter` WHERE `blotter_id`=$id";

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


if ($_GET["action"] === "printData") {

  // get id from hidden field in form
  $id = $_POST["id"];

  $sql = "SELECT * FROM `blotter` WHERE `blotter_id`=$id";
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


// function to fetch archive data
if ($_GET["action"] === "fetchArchiveData") {

  $sql = "SELECT * FROM `blotter` WHERE blotter_status = 'Settled'";

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

?>