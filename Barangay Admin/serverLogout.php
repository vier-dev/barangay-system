<?php
    session_start();
    unset($_SESSION["auth"]);
    unset($_SESSION["auth_user"]);

    $_SESSION['message'] = "Logged Out Successfully";
    header("Location: adminLogin.php");
    exit(0);
?>