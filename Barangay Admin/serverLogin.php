<?php
session_start();
include './api/config/database.php';

if(isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);


    $sql = "SELECT * FROM users WHERE name='$name' AND email='$email' LIMIT 1";
    $sql_run = mysqli_query($conn, $sql);

    if(mysqli_num_rows($sql_run) > 0) {

        //loop and get data you need
        foreach ($sql_run as $data) {
            $id = $data['id'];
            $name = $data['name'];
            $email = $data['email'];
        }

        $_SESSION['auth'] = true;

        // Storing Authenticated User data in Session
        $_SESSION['auth_user'] = [
            'id' => $id,
            'name' => $name,
            'email' => $email
        ];

        $_SESSION['message-success'] = "You are now logged in!";
        header("Location: dashboard.php");
        exit(0);
    }
    else
    {
        $_SESSION['message-failed'] = "Email or Password is incorrect!";
        header("Location: adminLogin.php");
        exit(0);
    }
}
?>