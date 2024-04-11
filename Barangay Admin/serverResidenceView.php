<?php
include "./api/config/database.php";

// function to fetch data
if ($_GET["action"] === "blotterHistory") {

    $sql = "SELECT * FROM `blotter` ";
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


// function to fetch data based on full_name
if ($_GET["action"] === "refreshBlotterHistory") {

  $sql = "SELECT * FROM `blotter`";
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

?>