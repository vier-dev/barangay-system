<?php
include './api/config/database.php';


// function to fetch data
if ($_GET["action"] === "fetchPending") {

  $sql = "SELECT * FROM `queries` WHERE status IN ('Pending', 'On Process')";

  $result = mysqli_query($conn, $sql);
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }

  mysqli_close($conn);

  header('ContentType: application/json');
  echo json_encode([
    "data" => $data
  ]);
}


if ($_GET["action"] === "fetchAnnouncement") {

  $sql = "SELECT * FROM `announcement`";
  $result = mysqli_query($conn, $sql);

  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }

  mysqli_close($conn);

  header('ContentType: application/json');
  echo json_encode([
    "data" => $data
  ]);
}
