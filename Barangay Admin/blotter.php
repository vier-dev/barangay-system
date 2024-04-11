<?php
session_start();
include './app/components/head.php';
include './api/config/database.php';

?>

<link rel="stylesheet" href="./app/assets/css/blotter.css">


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

                <div class="item"><a href="#" class="active">
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
            <h1>Blotter Management</h1>

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

            <div class="buttons">
                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalOpen">
                    <div class="d-flex align-items-center">
                        <span class="material-icons-sharp px-2"> book </span> New Blotter
                    </div>
                </button>

                <div class="button-2 ">
                    <button type="button" class="btn btn-warning mb-4 mx-2">
                        <a href="blotterArchives.php">
                            <div class="d-flex align-items-center">
                                <span class="material-icons-sharp px-2"> view_list </span> Blotter Archives
                            </div>
                        </a>
                    </button>

                    <button type="button" class="btn btn-secondary mb-4">
                        <a href="#">
                            <div class="d-flex align-items-center" style="color: white;">
                                <span class="material-icons-sharp px-2" > print </span> Print
                            </div>
                        </a>
                    </button>
                </div>
            </div>

            <table class="table table-striped table-hover align-middle" id="myTable" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center">CASE ID</th>
                        <th class="text-center">DEFENDANT</th>
                        <th class="text-center">COMPLAINANT'S NAME</th>
                        <th class="text-center">ACCUSATION</th>
                        <th class="text-center">DATE FILED</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">ACTION</th>
                    </tr>
                </thead>
                <tbody class="text-center"></tbody>
            </table>
            <!-- Table data end -->


            <!-- Insert Data -->
            <div class="modal fade" id="modalOpen" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalOpen" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalOpen">Barangay Official Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="insertForm">

                                <div class="row">
                                    <div class="mb-3 capitalize col-md-6 col-sm-6">
                                        <label for="defendant" class="form-label">Defendant's Name</label>
                                        <select name="defendant" id="defendant" class="form-control" required>
                                        <option value="" selected disabled hidden>Defendant</option>
                                           <?php
                                                $defendant = "SELECT full_name FROM residents";
                                                $result = mysqli_query($conn, $defendant);

                                                if($result){
                                                    if(mysqli_num_rows($result) > 0) {
                                                        foreach ($result as $resident_name) 
                                                        {
                                                            ?>
                                                            <option value="<?= $resident_name['full_name'] ;?>"><?= $resident_name['full_name'] ;?></option>
                                                            <?php
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo '<option value="">No Name</option>';
                                                    }
                                                }
                                                else
                                                {
                                                    echo '<option value="">Something wrong</option>';
                                                }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3 capitalize col-md-6 col-sm-6">
                                        <label for="complainant" class="form-label">Complainant's Name</label>
                                        <select name="complainant" id="complainant" class="form-control" required>
                                        <option value="" selected disabled hidden>Complainant</option>
                                           <?php
                                                $complainant = "SELECT full_name FROM residents";
                                                $result = mysqli_query($conn, $complainant);

                                                foreach ($result as $row) 
                                                {
                                                    echo '<option value="' .$row['full_name']. '">' .$row['full_name'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6 col-sm-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="" selected disabled hidden>Status</option>
                                            <option value="Active">Active</option>
                                            <option value="Settled">Settled</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6 col-sm-6">
                                        <label for="date" class="form-label">Date of Complain</label>
                                        <input type="date" id="date" name="date" class="form-control" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="accusation" class="form-label">Accusation</label>
                                    <textarea class="form-control" id="accusation" name="accusation" rows="3" placeholder="Enter your report here..."></textarea>
                                </div>

                                <button type="submit" class="btn btn-success" id="insertBtn">Add Blotter Information</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalUpdate" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalUpdate" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalUpdate">Edit Barangay Official Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="updateForm">

                                <input type="hidden" name="id" id="id">

                                <div class="row">
                                    <div class="mb-3 capitalize col-md-6 col-sm-6">
                                        <label for="defendant" class="form-label">Defendant's Name</label>
                                        <select name="defendant" id="defendant" class="form-control" required>
                                        <option value="" selected disabled hidden>Defendant</option>
                                            <?php
                                                $defendant = "SELECT full_name FROM residents";
                                                $result = mysqli_query($conn, $defendant);

                                                if($result){
                                                    if(mysqli_num_rows($result) > 0) {
                                                        foreach ($result as $resident_name) 
                                                        {
                                                            ?>
                                                            <option value="<?= $resident_name['full_name'] ;?>"><?= $resident_name['full_name'] ;?></option>
                                                            <?php
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo '<option value="">No Name</option>';
                                                    }
                                                }
                                                else
                                                {
                                                    echo '<option value="">Something wrong</option>';
                                                }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3 capitalize col-md-6 col-sm-6">
                                        <label for="complainant" class="form-label">Complainant's Name</label>
                                        <select name="complainant" id="complainant" class="form-control" required>
                                        <option value="" selected disabled hidden>Complainant</option>
                                            <?php
                                                $complainant = "SELECT full_name FROM residents";
                                                $result = mysqli_query($conn, $complainant);

                                                foreach ($result as $row) 
                                                {
                                                    echo '<option value="' .$row['full_name']. '">' .$row['full_name'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6 col-sm-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="" selected disabled hidden>Status</option>
                                            <option value="Active">Active</option>
                                            <option value="Settled">Settled</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6 col-sm-6">
                                        <label for="date" class="form-label">Date of Complain</label>
                                        <input type="date" id="date" name="date" class="form-control" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="accusation" class="form-label">Accusation</label>
                                    <textarea class="form-control" id="accusation" name="accusation" rows="3" placeholder="Enter your report here..."></textarea>
                                </div>

                                <button type="submit" class="btn btn-success" id="updateBtn">Update Blotter Information</button>
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
                            <h1 class="modal-title fs-5" id="modalDelete">Delete Blotter Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-2">
                            Are you sure to delete this Blotter Info?

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

<script src="./app/object-js/blotter.js"></script>

<?php

?>