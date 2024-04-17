<?php
session_start();
include './app/components/head.php';

?>

<link rel="stylesheet" href="./app/assets/css/officials.css">

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

                <div class="item"><a href="#" class="active">
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
            <h1>Barangay Officials Management</h1>

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
            <div class="row">
                <!-- Barangay Captain -->

                <div class="col-md-3 col-sm-3">
                    
                    <div id="card-container"></div>

                    <button class="btn btn-success mt-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#canvasCaptain" aria-controls="canvasCaptain" style="margin-left: 2.6rem;">
                        Barangay Captain Information
                    </button>
                    
                </div>


                <div class="offcanvas offcanvas-end w-50" data-bs-backdrop="static" tabindex="-1" id="canvasCaptain" aria-labelledby="staticBackdropLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="staticBackdropLabel">Barangay Captain Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">

                        <form method="POST" id="insertCaptainForm">

                            <div class="mb-3">
                                <label for="name" class="form-label">Official Name</label>
                                <input type="text" class="form-control " name="name" id="name" placeholder="John" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control " name="address" id="address" placeholder="123 Street, Corner Ave." required>
                            </div>

                            <input type="hidden" class="form-control " name="position" id="position" value="Barangay Captain">
                            <input type="hidden" class="form-control " name="description" id="description" value="Captain">

                            <div class="row">

                                <div class="mb-3 col-md-6 col-sm-6">
                                    <label for="birthday" class="form-label">Date of Birth:</label>
                                    <input type="date" id="birthday" name="birthday" class="form-control" required>
                                </div>

                                <div class="mb-3 col-md-6 col-sm-6">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="" selected disabled hidden>Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row my-4 d-flex align-items-center">
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
                            <button type="submit" class="btn btn-success mt-4" id="insertCaptainBtn">Add Official Information</button>
                        </form>
                    </div>
                </div>



                <div class="officialTable mt-3 col-md-9 col-sm-9">

                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegisterUser">
                        <div class="d-flex align-items-center">
                            <span class="material-icons-sharp px-2"> groups </span> New Officials
                        </div>
                    </button>

                    <table class="table table-striped table-hover align-middle" id="myTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">IMAGE</th>
                                <th class="text-center">NAME</th>
                                <th class="text-center">GENDER</th>
                                <th class="text-center">POSITION</th>
                                <th class="text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody class="text-center"></tbody>
                    </table>
                </div>
                <!-- Table data end -->
            </div>


            <div class="modal fade" id="modalRegisterUser" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalRegisterUser" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalRegisterUser">Barangay Official Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="insertForm">

                                <div class="row">
                                    <div class="mb-3 capitalize col-md-7 col-sm-7">
                                        <label for="name" class="form-label">Official Name</label>
                                        <input type="text" class="form-control " name="name" id="name" placeholder="John" required>
                                    </div>

                                    <div class="mb-3 col-md-5 col-sm-5">
                                        <label for="birthday" class="form-label">Date of Birth:</label>
                                        <input type="date" id="birthday" name="birthday" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-7 col-sm-7">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control " name="address" id="address" placeholder="123 Street, Corner Ave." required>
                                    </div>

                                    <div class="mb-3 col-md-5 col-sm-5">
                                        <label for="position" class="form-label">Position</label>
                                        <select name="position" id="position" class="form-control">
                                            <option value="" selected disabled hidden>Position</option>
                                            <option value="Barangay Councilor">Councilor</option>
                                            <option value="SK Chairman">SK Chairman</option>
                                            <option value="Barangay Secretary">Barangay Secretary</option>
                                            <option value="Barangay Treasurer">Barangay Treasurer</option>
                                            <option value="Barangay Police">Barangay Police</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="opt my-3">
                                    <div>
                                        <div class="form-group">
                                            <label class="form-label">Gender:</label>
                                            &nbsp;&nbsp;
                                            <input type="radio" class="form-check-input" name="gender" value="Male">
                                            <label class="form-input-label">Male</label>
                                            &nbsp;&nbsp;
                                            <input type="radio" class="form-check-input" name="gender" value="Female">
                                            <label class="form-input-label">Female</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>

                                <div class="row my-4 d-flex align-items-center">
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
                                <button type="submit" class="btn btn-success" id="insertBtn">Add Official Information</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalUpdateUser" tabindex="-1" aria-labelledby="modalUpdateUser" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalUpdateUser">Edit Barangay Official Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="updateForm">

                                <div class="row">
                                    <div class="mb-3 capitalize col-md-7 col-sm-7">
                                        <input type="hidden" name="id" id="id">
                                        <label for="name" class="form-label">Official Name</label>
                                        <input type="text" class="form-control " name="name" id="name" placeholder="John" required>
                                    </div>

                                    <div class="mb-3 col-md-5 col-sm-5">
                                        <label for="birthday" class="form-label">Date of Birth:</label>
                                        <input type="date" id="birthday" name="birthday" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-7 col-sm-7">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control " name="address" id="address" placeholder="123 Street, Corner Ave." required>
                                    </div>
                                    <div class="mb-3 col-md-5 col-sm-5">
                                        <label for="position" class="form-label">Position</label>
                                        <select name="position" id="position" class="form-control">
                                            <option value="" selected disabled hidden>Position</option>
                                            <option value="Barangay Councilor">Councilor</option>
                                            <option value="SK Chairman">SK Chairman</option>
                                            <option value="Barangay Secretary">Barangay Secretary</option>
                                            <option value="Barangay Treasurer">Barangay Treasurer</option>
                                            <option value="Barangay Police">Barangay Police</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="opt my-3">
                                    <div>
                                        <div class="form-group">
                                            <label class="form-label">Gender:</label>
                                            &nbsp;&nbsp;
                                            <input type="radio" class="form-check-input" name="gender" value="Male">
                                            <label class="form-input-label">Male</label>
                                            &nbsp;&nbsp;
                                            <input type="radio" class="form-check-input" name="gender" value="Female">
                                            <label class="form-input-label">Female</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>

                                <div class="row my-4 d-flex align-items-center">
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
                                <button type="submit" class="btn btn-success" id="updateBtn">Update Official Information</button>
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
                            <h1 class="modal-title fs-5" id="modalRegisterUser">Delete Resident Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-2">
                            Are you sure to delete this Barangay Official?

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

<script src="./app/object-js/officials.js"></script>

<?php
?>