<?php
session_start();
include './app/components/head.php';
?>

<link rel="stylesheet" href="./app/assets/css/adminRegister.css">


<div class="wrapper">

    <main>

        <h1>Admin Account Register</h1>

        <!-- Car registration form -->

        <div class="bondModel">
            <a href="adminLogin.php">
                <button type="submit" class="btn btn-danger my-3" id="backBtn">Back to Login</button>
            </a>
            
            <div class="bondNavTop">Register Account</div>

            <form method="POST" id="insertForm">

                <div class="row">
                    <div class="mb-3 capitalize col-md-6 col-sm-12">
                        <label for="bond_name" class="form-label">Name</label>
                        <input type="text" class="form-control " name="name" id="name" placeholder="John" required>
                    </div>

                    <div class="mb-3 capitalize col-md-3 col-sm-12">
                        <label for="bond_name" class="form-label">Age</label>
                        <input type="text" class="form-control " name="age" id="age" placeholder="30" required>
                    </div>

                    <div class="mb-3 col-md-3 col-sm-6">
                        <label for="bond_phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control phone" name="phone" id="phone" placeholder="x-(xxx)-xxx-xxxx" required>
                    </div>

                    <div class="mb-3 col-md-6 col-sm-6 capitalize">
                        <label for="bond_address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="123 Sesame St. Philippines" required>
                    </div>

                    <div class="mb-3 col-md-4 col-sm-4">
                        <label for="bond_email" class="form-label"> Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="sample@sample.com" required>
                    </div>

                    <div class="mb-3 col-md-2 col-sm-2">
                        <label for="user_type" class="form-label">User Type</label>
                        <select name="user_type" id="user_type" class="form-control">
                            <option value="" selected disabled hidden>User Type</option>
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success mt-3" id="insertBtn">Register New User</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- Right Section -->
    <div class="right-section">

        <div class="admin-profile">
            <div class="logo">
                <img width="48" height="48" src="https://img.icons8.com/color/48/car-sale.png" alt="car-sale" />
                <h2>Car Dealearship</h2>
                <p>Authentic Car Dealearship Company</p>
            </div>
        </div>
    </div>
    <!--End of right section-->
</div>


<!-- Toast container  -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <!-- Success toast  -->
    <div class="toast align-items-center text-bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="successToast">
        <div class="d-flex">
            <div class="toast-body">
                <strong>Success!</strong>
                <span id="successMsg"></span>
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <!-- Error toast  -->
    <div class="toast align-items-center text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true" id="errorToast">
        <div class="d-flex">
            <div class="toast-body">
                <strong>Error!</strong>
                <span id="errorMsg"></span>
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script src="/app/object-js/register.js"></script>
<?php
?>