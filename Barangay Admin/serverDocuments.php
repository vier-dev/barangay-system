<?php
include "./api/config/database.php";

// function to fetch data
if ($_GET["action"] === "fetchData") {
   
    $sql = "SELECT * FROM `queries`";

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


if($_GET['action'] === 'insertData') {
    if(!empty($_POST['name']) && !empty($_POST['subject']) && !empty($_POST['date']) && !empty($_POST['purpose']) && !empty($_POST['status']) && !empty($_POST['fee'])) {

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $fee = mysqli_real_escape_string($conn, $_POST['fee']);

        $sql = "INSERT INTO `queries` (`document_id`, `name`, `subject`, `document_fee`, `date`, `purpose`, `status`) 
                VALUES (NULL, '$name', '$subject', '$fee', '$date', '$purpose', '$status')";

        if(mysqli_query($conn, $sql)) {

            echo json_encode([
                "statusCode" => 200,
                "message" => "Successfully added a new Query"
            ]);
        } else {
            echo json_encode([
                "statusCode" => 500,
                "message" => "Failed to add a new Query"
            ]);
        }
    } else {
        echo json_encode([
            "statusCode" => 400,
            "message" => "Please fill all the required fields"
        ]);
    }
}


if($_GET['action'] === 'fetchSingle') {

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $sql = "SELECT * FROM `queries` WHERE  document_id='$id'";
    
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
            "message" => "No query found with this id"
        ]);
    }
    mysqli_close($conn);
}


if($_GET['action'] === 'updateData') {
    if(!empty($_POST['name']) && !empty($_POST['subject']) && !empty($_POST['date']) && !empty($_POST['purpose']) && !empty($_POST['status']) && !empty($_POST['fee'])) {

        $id = mysqli_real_escape_string($conn, $_POST['id']);

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $fee = mysqli_real_escape_string($conn, $_POST['fee']);

        $sql = "UPDATE `queries` SET `name`='$name', `subject`='$subject', `document_fee`='$fee', `date`='$date', `purpose`='$purpose', `status`='$status' WHERE `document_id`=$id";

        if(mysqli_query($conn, $sql)) {

            echo json_encode([
                "statusCode" => 200,
                "message" => "Updated the Query"
            ]);
        } else {
            echo json_encode([
                "statusCode" => 500,
                "message" => "Failed to update Query"
            ]);
        }
    } else {
        echo json_encode([
            "statusCode" => 400,
            "message" => "Please fill all the required fields"
        ]);
    }
}


if($_GET['action'] === 'deleteData') {

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $sql = "DELETE FROM `queries` WHERE `document_id`=$id";

    if (mysqli_query($conn, $sql)) {

    echo json_encode([
          "statusCode" => 200,
          "message" => "Query deleted successfully"
    ]);
    } else {
        echo json_encode([
            "statusCode" => 500,
            "message" => "Failed to delete query"
        ]);
    }
}



//documents view
// view data of individual user
if ($_GET["action"] === "viewData") {

    // get id from hidden field in form
    $id = $_POST["id"];
  
    $sql = "SELECT * FROM `queries` WHERE `document_id`=$id";
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

// function to fetch data
if ($_GET["action"] === "showDocumentHistory") {

    $sql = "SELECT * FROM `queries` WHERE status='Approved'";

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