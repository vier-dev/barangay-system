<?php
session_start();
include './api/config/database.php';
include './app/components/head.php';

?>

<link rel="stylesheet" href="./app/assets/css/documents.css">

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

                <div class="item"><a href="#" class="active">
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

    <!-- Main Content -->
    <main class="container">

        <div class="top d-flex justify-content-between align=items-center mt-3">
            <h1>Document/Query Section</h1>

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

        <!-- Analyses -->
        <div class="documents">

            <div class="d-flex justify-content-center row_1">
                <div class="status ">
                    <div class="icon">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <div class="details">
                        <h4>Barangay Certificate</h4>
                        <div>
                            <?php
                            $brgy_cert_query = "SELECT * FROM `queries` WHERE subject = 'Barangay Certificate'";
                            $brgy_cert_query_run = mysqli_query($conn, $brgy_cert_query);

                            if ($cert_total = mysqli_num_rows($brgy_cert_query_run)) echo '<h4>' . $cert_total . '</h4>';
                            else echo '<h4> 0 </h4>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center row_2">
                <div class="status ">
                    <div class="icon">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <div class="details">
                        <h4>Indigency Certificate</h4>
                        <div id="num_query_container">
                            <?php
                            $indigency_query = "SELECT * FROM `queries` WHERE subject = 'Barangay Indigency'";
                            $indigency_query_run = mysqli_query($conn, $indigency_query);

                            if ($indigency_total = mysqli_num_rows($indigency_query_run)) echo '<h4> ' . $indigency_total . ' </h4>';
                            else echo '<h4> 0 </h4>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center row_3">
                <div class="status ">
                    <div class="icon">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <div class="details">
                        <h4>Barangay Residency </h4>
                        <div id="num_query_container">
                            <?php
                            $brgy_residency_cert = "SELECT * FROM `queries` WHERE subject = 'Barangay Residency'";
                            $brgy_residency_cert_run = mysqli_query($conn, $brgy_residency_cert);

                            if ($residency_total = mysqli_num_rows($brgy_residency_cert_run)) echo '<h4> ' . $residency_total . ' </h4>';
                            else echo '<h4> 0 </h4>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center row_4">
                <div class="status ">
                    <div class="icon">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <div class="details">
                        <h4>First Time Job Seeker</h4>
                        <div id="num_query_container">
                            <?php
                            $job_seeker_cert = "SELECT * FROM `queries` WHERE subject = 'First Time Job Seeker'";
                            $job_seeker_cert_run = mysqli_query($conn, $job_seeker_cert);

                            if ($job_total = mysqli_num_rows($job_seeker_cert_run)) echo '<h4> ' . $job_total . ' </h4>';
                            else echo '<h4> 0 </h4>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2nd row -->
            <div class="d-flex justify-content-center row_1">
                <div class="status ">
                    <div class="icon">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <div class="details">
                        <h4>Barangay Clearance</h4>
                        <div id="num_query_container">
                            <?php
                            $brgy_clearance_query = "SELECT * FROM `queries` WHERE subject = 'Barangay Clearance'";
                            $brgy_clearance_query_run = mysqli_query($conn, $brgy_clearance_query);

                            if ($clearance_total = mysqli_num_rows($brgy_clearance_query_run)) echo '<h4> ' . $clearance_total . ' </h4>';
                            else echo '<h4> 0 </h4>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center row_2">
                <div class="status ">
                    <div class="icon">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <div class="details">
                        <h4>Business Permit Cert.</h4>
                        <div id="num_query_container">
                            <?php
                            $permit_query = "SELECT * FROM `queries` WHERE subject = 'Business Permit'";
                            $permit_query_run = mysqli_query($conn, $permit_query);

                            if ($permit_total = mysqli_num_rows($permit_query_run)) echo '<h4> ' . $permit_total . ' </h4>';
                            else echo '<h4> 0 </h4>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center row_3">
                <div class="status ">
                    <div class="icon">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <div class="details">
                        <h4>Non-Residency Cert.</h4>
                        <div id="num_query_container">
                            <?php
                            $non_resident_query = "SELECT * FROM `queries` WHERE subject = 'Barangay Non-Residency'";
                            $non_resident_query_run = mysqli_query($conn, $non_resident_query);

                            if ($non_residency_total = mysqli_num_rows($non_resident_query_run)) echo '<h4> ' . $non_residency_total . ' </h4>';
                            else echo '<h4> 0 </h4>';
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End of Analyses -->

        <button type="button" class="btn btn-primary my-4" data-bs-toggle="modal" data-bs-target="#modalAdd">
            <div class="d-flex align-items-center">
                <span class="material-icons-sharp px-2"> description </span> New Query
            </div>
        </button>

        <div class="documentTable mb-3">
            <table class="table table-striped table-hover align-middle" id="documentTable" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">NAME</th>
                        <th class="text-center">SUBJECT</th>
                        <th class="text-center">PURPOSE</th>
                        <th class="text-center">DATE FILED</th>
                        <th class="text-center">ACTION</th>
                    </tr>
                </thead>
                <tbody class="text-center"></tbody>
            </table>
            <!-- Table data end -->
        </div>

        <div class="modal fade" id="modalAdd" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalAdd" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalAdd">Add New Query</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" id="insertForm">

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control " name="name" id="name" placeholder="Johnny Cage" required>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-7 col-sm-7">
                                    <label for="subject" class="form-label">Document Type</label>
                                    <select name="subject" id="subject" class="form-control">
                                        <option value="" selected disabled hidden>Subject</option>
                                        <option value="Barangay Certificate">Barangay Certificate</option>
                                        <option value="Barangay Indigency">Barangay Indigency</option>
                                        <option value="Barangay Residency">Barangay Residency</option>
                                        <option value="Barangay Clearance">Barangay Clearance</option>
                                        <option value="Business Permit">Business Permit</option>
                                        <option value="Barangay Non-Residency">Barangay Non-Residency</option>
                                        <option value="First Time Job Seeker">First Time Job Seeker</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-5 col-sm-5">
                                    <label for="date" class="form-label">Date of Filing</label>
                                    <input type="date" id="date" name="date" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="purpose" class="form-label">Purpose</label>
                                <textarea class="form-control" id="purpose" name="purpose" placeholder="For Employment" rows="3"></textarea>
                            </div>

                            <div class="my-3">
                                <div class="row">
                                    <div class="form-group col-md-5 col-sm-5">
                                        <label class="form-label">Status</label><br>
                                        <input type="radio" class="form-check-input" name="status" value="Pending">
                                        <label class="form-input-label">Pending</label>
                                        &nbsp;&nbsp;
                                        <input type="radio" class="form-check-input" name="status" value="On Process">
                                        <label class="form-input-label">On Process</label>
                                        &nbsp;&nbsp;
                                        <input type="radio" class="form-check-input" name="status" value="Approved">
                                        <label class="form-input-label">Approved</label>
                                    </div>

                                    <div class="form-group col-md-7 col-sm-7">
                                        <label class="form-label">Document Fee</label><br>
                                        <input type="radio" class="form-check-input" name="fee" value="25">
                                        <label class="form-input-label">₱25</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" class="form-check-input" name="fee" value="50">
                                        <label class="form-input-label">₱50</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" class="form-check-input" name="fee" value="75">
                                        <label class="form-input-label">₱75</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" class="form-check-input" name="fee" value="100">
                                        <label class="form-input-label">₱100</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" class="form-check-input" name="fee" value="125">
                                        <label class="form-input-label">₱125</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" class="form-check-input" name="fee" value="150">
                                        <label class="form-input-label">₱150</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mt-3" id="insertBtn">Create New Query</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalUpdate" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalUpdate" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalUpdate">Edit Query</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" id="updateForm">

                            <input type="hidden" name="id" id="id">

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control " name="name" id="name" placeholder="Johnny Cage" required>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-7 col-sm-7">
                                    <label for="subject" class="form-label">Document Type</label>
                                    <select name="subject" id="subject" class="form-control">
                                        <option value="" selected disabled hidden>Subject</option>
                                        <option value="Barangay Certificate">Barangay Certificate</option>
                                        <option value="Barangay Indigency">Barangay Indigency</option>
                                        <option value="Barangay Residency">Barangay Residency</option>
                                        <option value="Barangay Clearance">Barangay Clearance</option>
                                        <option value="Business Permit">Business Permit</option>
                                        <option value="Barangay Non-Residency">Barangay Non-Residency</option>
                                        <option value="First Time Job Seeker">First Time Job Seeker</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-5 col-sm-5">
                                    <label for="date" class="form-label">Date of Filing</label>
                                    <input type="date" id="date" name="date" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="purpose" class="form-label">Purpose</label>
                                <textarea class="form-control" id="purpose" name="purpose" rows="3"></textarea>
                            </div>

                            <div class="my-3">
                                <div class="row">
                                    <div class="form-group col-md-5 col-sm-5">
                                        <label class="form-label">Status</label><br>
                                        <input type="radio" class="form-check-input" name="status" value="Pending">
                                        <label class="form-input-label">Pending</label>
                                        &nbsp;&nbsp;
                                        <input type="radio" class="form-check-input" name="status" value="On Process">
                                        <label class="form-input-label">On Process</label>
                                        &nbsp;&nbsp;
                                        <input type="radio" class="form-check-input" name="status" value="Approved">
                                        <label class="form-input-label">Approved</label>
                                    </div>

                                    <div class="form-group col-md-7 col-sm-7">
                                        <label class="form-label">Document Fee</label><br>
                                        <input type="radio" class="form-check-input" name="fee" value="25">
                                        <label class="form-input-label">₱25</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" class="form-check-input" name="fee" value="50">
                                        <label class="form-input-label">₱50</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" class="form-check-input" name="fee" value="75">
                                        <label class="form-input-label">₱75</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" class="form-check-input" name="fee" value="100">
                                        <label class="form-input-label">₱100</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" class="form-check-input" name="fee" value="125">
                                        <label class="form-input-label">₱125</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" class="form-check-input" name="fee" value="150">
                                        <label class="form-input-label">₱150</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success" id="updateBtn">Update Query</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Data -->
        <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDelete" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalDelete">Delete Query</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mt-2">
                        Are you sure to delete this Query?

                        <div class="form-group">
                            <button type="button" id="delete" name="delete" class="btn btn-danger mt-3">Delete Query</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End of Main Content -->
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
<script src="./app/object-js/documents.js"></script>

<?php

?>