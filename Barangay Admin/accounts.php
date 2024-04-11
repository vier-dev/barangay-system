<?php
session_start();
include './app/components/head.php';

?>

<link rel="stylesheet" href="./app/assets/css/users.css">

<div class="wrapper">

    <!-- Sidebar Section -->
    <aside>

        <div class="toggle">
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">
                    close
                </span>
            </div>
        </div>


        <div class="sidebar">
            <div class="menu">

                <h5 class="sidebar-name mb-3">LOGS</h5>

                <div class="item"><a href="dashboard.php">
                        <span class="material-icons-sharp">
                            dashboard
                        </span>Dashboard</a>
                </div>

                <div class="item"><a href="residence.php">
                        <span class="material-icons-sharp">
                            home
                        </span>Residence</a>
                </div>

                <div class="item"><a href="documents.php">
                        <span class="material-icons-sharp">
                            question_mark
                        </span>Docs/Queries</a>
                </div>

                <div class="item"><a href="blotter.php">
                        <span class="material-icons-sharp">
                            folder
                        </span>Blotter</a>
                </div>

                <div class="item"><a href="officials.php">
                        <span class="material-icons-sharp">
                            groups
                        </span>Officials</a>
                </div>

                <div class="item">
                    <a class="sub-btn">
                        <span class="material-icons-sharp">
                            report_gmailerrorred
                        </span>Reports
                        <span class="material-icons-sharp dropdown">
                            chevron_right
                        </span>
                    </a>

                    <div class="sub-menu">
                        <div class="sub-item"><a href="incomeReport.php">Stats Report</a></div>
                        <div class="sub-item"><a href="otherReport.php">Events</a></div>
                    </div>
                </div>

                <div class="item"><a href="#" class="active">
                        <span class="material-icons-sharp">
                            account_circle
                        </span>Accounts</a>
                </div>

                <!-- Logout button -->
                <?php if (!isset($_SESSION['auth']))
                ?>
                <div class="item"><a href="serverLogout.php">
                        <span class="material-icons-sharp">
                            logout
                        </span>Logout</a>
                </div>
                <?php
                ?>
            </div>
        </div>
    </aside>
    <!-- End of Sidebar Section -->

    <!--Main content-->
    <main class="container">
        <div class="top d-flex justify-content-between align=items-center mt-3">
            <h1>System User Accounts</h1>

            <!-- shows who logged in -->
            <?php if (isset($_SESSION['auth_user'])) : ?>
                <div class="nav">
                    <button id="menu-btn">
                        <span class="material-icons-sharp">
                            menu
                        </span>
                    </button>
                    <div class="profile">
                        <div class="info">
                            <p>Hey, <b><?= $_SESSION['auth_user']['name']; ?></b>!</p>
                        </div>

                        <div class="profile-photo">
                            <img width="48" height="48" src="https://img.icons8.com/color/48/circled-user-male-skin-type-7--v1.png" alt="circled-user-male-skin-type-7--v1" />
                        </div>
                    </div>
                </div>
            <?php else : ?>
            <?php endif; ?>
        </div>

        <div class="mt-3">

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaRegisterUser">
                <div class="d-flex align-items-center">
                    <span class="material-icons-sharp mx-1"> admin_panel_settings </span>Add User Account
                </div>
            </button>

            <div class="modal fade" id="modaRegisterUser" tabindex="-1" aria-labelledby="modaRegisterUser" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modaRegisterUser">User Account</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="insertForm">

                                <div class="mb-3 capitalize">
                                    <label for="bond_name" class="form-label">Name</label>
                                    <input type="text" class="form-control " name="name" id="name" placeholder="John" required>
                                </div>

                                <div class="row">
                                    <div class="mb-3 capitalize col-md-3 col-sm-3">
                                        <label for="bond_name" class="form-label">Age</label>
                                        <input type="text" class="form-control " name="age" id="age" placeholder="30" required>
                                    </div>

                                    <div class="mb-3 col-md-9 col-sm-9">
                                        <label for="bond_phone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control phone" name="phone" id="phone" placeholder="x-(xxx)-xxx-xxxx" required>
                                    </div>
                                </div>

                                <div class="mb-3 capitalize">
                                    <label for="bond_address" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="123 Sesame St. Philippines" required>
                                </div>
                                <div class="row mb-3">
                                    <div class="mb-3 col-md-7 col-sm-7">
                                        <label for="bond_email" class="form-label"> Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="sample@sample.com" required>
                                    </div>

                                    <div class="mb-3 col-md-5 col-sm-5">
                                        <label for="user_type" class="form-label">User Type</label>
                                        <select name="user_type" id="user_type" class="form-control">
                                            <option value="" selected disabled hidden>User Type</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Staff">Staff</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" id="insertBtn">Add User Information</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalUpdateUser" tabindex="-1" aria-labelledby="modalUpdateUser" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalUpdateUser">Update User Account</h1>    
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="updateForm">

                                <div class="mb-3 capitalize">
                                    <label for="bond_name" class="form-label">Name</label>
                                    <input type="text" class="form-control " name="name" id="name" placeholder="John" required>
                                    <input type="hidden" name="id" id="id">
                                </div>

                                <div class="row">
                                    <div class="mb-3 capitalize col-md-3 col-sm-3">
                                        <label for="bond_name" class="form-label">Age</label>
                                        <input type="text" class="form-control " name="age" id="age" placeholder="30" required>
                                    </div>

                                    <div class="mb-3 col-md-9 col-sm-9">
                                        <label for="bond_phone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control phone" name="phone" id="phone" placeholder="x-(xxx)-xxx-xxxx" required>
                                    </div>
                                </div>

                                <div class="mb-3 capitalize">
                                    <label for="bond_address" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="123 Sesame St. Philippines" required>
                                </div>
                                <div class="row mb-3">
                                    <div class="mb-3 col-md-7 col-sm-7">
                                        <label for="bond_email" class="form-label"> Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="sample@sample.com" required>
                                    </div>

                                    <div class="mb-3 col-md-5 col-sm-5">
                                        <label for="user_type" class="form-label">User Type</label>
                                        <select name="user_type" id="user_type" class="form-control">
                                            <option value="" selected disabled hidden>User Type</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Staff">Staff</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" id="updateBtn">Edit User Information</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalDeleteUser" tabindex="-1" aria-labelledby="modalDeleteUser" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modaRegisterUser">Delete User Account</h1>  
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-2">
                            Are you sure to delete this user?

                            <div class="form-group">
                                <button type="button" id="delete" name="delete" class="btn btn-danger mt-3">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-3 userTable">
                <table class="table table-striped table-hover align-middle" id="myTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">NAME</th>
                            <th class="text-center">EMAIL</th>
                            <th class="text-center">USER TYPE</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="result"></tbody>
                </table>
            </div>
        </div>
    </main>
    <!--End of main content-->
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

<!-- JS   -->
<script src="./app/app.js"></script>

<script src="./app/object-js/account.js"></script>

<?php
?>