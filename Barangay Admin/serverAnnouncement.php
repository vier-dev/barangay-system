<?php
include './api/config/database.php';

if($_GET['action'] === 'fetchData') {
    $sql = "SELECT * FROM `announcement` ORDER BY announcement_id DESC ";

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


if($_GET['action'] === 'saveAnnouncement') {
    if(!empty($_POST['announcement_title']) && !empty($_POST['announcement_description']) && !empty($_POST['announcement_date'])) {

        $title = mysqli_real_escape_string($conn, $_POST['announcement_title']);
        $description = mysqli_real_escape_string($conn, $_POST['announcement_description']);
        $date = mysqli_real_escape_string($conn, $_POST['announcement_date']);

        $sql = "INSERT INTO `announcement` (`announcement_id`, `announcement_title`, `announcement_description`, `announcement_date`) 
        VALUES (NULL, '$title', '$description',' $date')";

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

?>