<?php
include './api/config/database.php';

if(!isset($_GET['id'])){
    echo "<script> alert('Undefined Schedule ID.'); location.replace('./otherReport.php') </script>";
    $conn->close();
    exit;
}

$delete = $conn->query("DELETE FROM `schedule_list` where id = '{$_GET['id']}'");
if($delete){
    echo "<script> location.replace('./otherReport.php') </script>";
}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}
$conn->close();
?>