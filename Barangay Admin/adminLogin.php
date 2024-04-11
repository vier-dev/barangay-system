<?php
session_start();
include './app/components/head.php';
?>

<link rel="stylesheet" href="./app/assets/css/adminLogin.css">

<div class="container">
    
    <div class="card">
        <div class="card-img-top mt-3">
            <span class="material-icons-sharp d-flex justify-content-center">
                account_circle
            </span>
            <h2 class="d-flex justify-content-center">Admin Login</h2>
        </div>
        <div class="card-body">
            <form id="register_form" action="serverLogin.php" method="POST">

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="John" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="admin@sample.com" required>
                </div>

                <div class="mb-2">
                    <a href="adminRegister.php">Already have an account?</a>
                </div>

                <button type="submit" class="btn" name="submit" id="submit">Admin Login</button>

            </form>
        </div>
    </div>

</div>

<?php

?>