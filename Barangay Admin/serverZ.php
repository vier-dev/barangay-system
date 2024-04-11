<?php
include './api/config/database.php';

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
?>

