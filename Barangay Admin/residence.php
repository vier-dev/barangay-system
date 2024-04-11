<?php
session_start();
include './app/components/head.php';

?>

<link rel="stylesheet" href="./app/assets/css/residence.css">

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

                <div class="item"><a href="#" class="active">
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

                <div class="item"><a href="accounts.php">
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

    <main class="container">
        <div class="top d-flex justify-content-between align=items-center mt-3">
            <h1>Resident Management</h1>

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

            <!-- Insert Data -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegisterUser">
                <div class="d-flex align-items-center">
                    <span class="material-icons-sharp mx-1"> person_add </span> New Resident
                </div>
            </button>

            <!-- Table Container -->
            <div class="residentTable mt-3">
                <table class="table table-striped table-hover align-middle" id="myTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">IMAGE</th>
                            <th class="text-center">RESIDENT'S NAME</th>
                            <th class="text-center">CIVIL STATUS</th>
                            <th class="text-center">CONTACT</th>
                            <th class="text-center">RESIDENT STATUS</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="text-center"></tbody>
                </table>
            </div>
            <!-- Table Container End -->

            <div class="modal fade" id="modalRegisterUser" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalRegisterUser" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalRegisterUser">Resident Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="insertForm">

                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Resident's Name</label><br>
                                    <small class="text-muted">(Lastname, Firstname, MI.)</small>
                                    <input type="text" class="form-control " name="full_name" id="full_name" placeholder="Dunkin Jr, John B." required>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6 col-sm-6">
                                        <label for="address" class="form-label">Resident Address</label>
                                        <input type="text" class="form-control " name="address" id="address" placeholder="123 Street, Corner Ave." required>
                                    </div>

                                    <div class="mb-3 col-md-6 col-sm-6">
                                        <label for="birthday" class="form-label">Date of Birth:</label>
                                        <input type="date" id="birthday" name="birthday" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="mb-3 col-md-4 col-sm-4">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control " name="phone" id="phone" placeholder="09123456789" required>
                                    </div>

                                    <div class="mb-3 col-md-4 col-sm-4">
                                        <label for="social_status" class="form-label">Social Status</label>
                                        <select name="social_status" id="social_status" class="form-control">
                                            <option value="" selected disabled hidden>Social Status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Single Parent">Single Parent</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Senior Citizen">Senior Citizen</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-4 col-sm-4">
                                        <label for="religion" class="form-label">Religion</label>
                                        <select name="religion" id="religion" class="form-control">
                                            <option value="" selected disabled hidden>Religion</option>
                                            <option value="Christian">Christian</option>
                                            <option value="Catholic">Catholic</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="opt">
                                    <div class="mb-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Gender:</label>
                                            &nbsp;&nbsp;
                                            <input type="radio" class="form-check-input" name="gender" value="Male">
                                            <label class="form-input-label">Male</label>
                                            &nbsp;&nbsp;
                                            <input type="radio" class="form-check-input" name="gender" value="Female">
                                            <label class="form-input-label">Female</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Resident Status:</label>
                                            &nbsp;&nbsp;
                                            <input type="radio" class="form-check-input" name="resident_status" value="Rented">
                                            <label class="form-input-label">Rented</label>
                                            &nbsp;&nbsp;
                                            <input type="radio" class="form-check-input" name="resident_status" value="Permanent">
                                            <label class="form-input-label">Permanent</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4 d-flex align-items-center">
                                    <label class="form-label">Upload Image</label>
                                    <div class="col-3">
                                        <img class="preview_img" src="./app/assets/images/user-preview.png">
                                    </div>
                                    <div class="col-9">
                                        <div class="file-upload text-secondary">
                                            <input type="file" class="image" name="image" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" id="insertBtn">Add Resident</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Update Data -->
            <div class="modal fade" id="modalUpdateUser" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalUpdateUser" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalRegisterUser">Edit Resident Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="updateForm">

                                <input type="hidden" name="id" id="id">

                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Resident's Name</label><br>
                                    <small class="text-muted">(Lastname, Firstname, MI.)</small>
                                    <input type="text" class="form-control " name="full_name" id="full_name" placeholder="Dunkin Jr, John B." required>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6 col-sm-6">
                                        <label for="address" class="form-label">Resident Address</label>
                                        <input type="text" class="form-control " name="address" id="address" placeholder="123 Street, Corner Ave." required>
                                    </div>

                                    <div class="mb-3 col-md-6 col-sm-6">
                                        <label for="birthday" class="form-label">Date of Birth:</label>
                                        <input type="date" id="birthday" name="birthday" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="mb-3 col-md-4 col-sm-4">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control " name="phone" id="phone" placeholder="09123456789" required>
                                    </div>

                                    <div class="mb-3 col-md-4 col-sm-4">
                                        <label for="social_status" class="form-label">Social Status</label>
                                        <select name="social_status" id="social_status" class="form-control">
                                            <option value="" selected disabled hidden>Social Status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Single Parent">Single Parent</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Senior Citizen">Senior Citizen</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-4 col-sm-4">
                                        <label for="religion" class="form-label">Religion</label>
                                        <select name="religion" id="religion" class="form-control">
                                            <option value="" selected disabled hidden>Religion</option>
                                            <option value="Christian">Christian</option>
                                            <option value="Catholic">Catholic</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="opt">
                                    <div class="mb-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Gender:</label>
                                            &nbsp;&nbsp;
                                            <input type="radio" class="form-check-input" name="gender" value="Male">
                                            <label class="form-input-label">Male</label>
                                            &nbsp;&nbsp;
                                            <input type="radio" class="form-check-input" name="gender" value="Female">
                                            <label class="form-input-label">Female</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Resident Status:</label>
                                            &nbsp;&nbsp;
                                            <input type="radio" class="form-check-input" name="resident_status" value="Rented">
                                            <label class="form-input-label">Rented</label>
                                            &nbsp;&nbsp;
                                            <input type="radio" class="form-check-input" name="resident_status" value="Permanent">
                                            <label class="form-input-label">Permanent</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4 d-flex align-items-center">
                                    <label class="form-label">Upload Image</label>
                                    <div class="col-3">
                                        <img class="preview_img" src="./app/assets/images/user-preview.png">
                                    </div>
                                    <div class="col-9">
                                        <div class="file-upload text-secondary">
                                            <input type="file" class="image" name="image" accept="image/*">
                                            <input type="hidden" name="image_old" id="image_old">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" id="updateBtn">Update Resident</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Delete Data -->
            <div class="modal fade" id="modalDeleteUser" tabindex="-1" aria-labelledby="modalDeleteUser" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modaRegisterUser">Delete Resident Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-2">
                            Are you sure to delete this Resident?

                            <div class="form-group">
                                <button type="button" id="delete" name="delete" class="btn btn-danger mt-3">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
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

<script src="./app/app.js"></script>

<script src="./app/object-js/residence.js"></script>

<?php
?>