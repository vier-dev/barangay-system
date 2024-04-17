<?php
session_start();
include './app/components/head.php';
include './api/config/database.php';

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
            <h1>View Resident Information</h1>

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

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="residence.php">Resident Management</a></li>
                    <li class="breadcrumb-item breadcrumb-active" aria-current="page">View Resident Information</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-4 col-sm-4">

                    <form id="viewForm" method="POST">

                        <div class="row d-flex align-items-center justify-content-center">
                            <div class="mb-4 col-md-3 col-sm-3">
                                <img id="preview_img" class="preview_img" src="./app/assets/images/user-preview.png">
                            </div>
                        </div>

                        <input type="hidden" name="id" id="id">

                        <div class="mb-3">
                            <label for="full_name" class="form-label">Resident's Name</label><br>
                            <input type="text" class="form-control " name="full_name" id="full_name" readonly>
                        </div>
                        
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-6">
                                <label for="gender" class="form-label">Gender</label>
                                <input class="form-control " name="gender" id="gender" readonly>
                            </div>

                            <div class="mb-3 col-md-6 col-sm-6">
                                <label for="birthday" class="form-label">Date of Birth</label>
                                <input id="birthday" name="birthday" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Resident Address</label>
                            <input class="form-control " name="address" id="address" readonly>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-6">
                                <label for="social_status" class="form-label">Social Status</label>
                                <input class="form-control " name="social_status" id="social_status" readonly>
                            </div>

                            <div class="mb-3 col-md-6 col-sm-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control " name="phone" id="phone" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-6">
                                <label for="religion" class="form-label">Religion</label>
                                <input id="religion" name="religion" class="form-control" readonly>
                            </div>

                            <div class="mb-3 col-md-6 col-sm-6">
                                <label for="resident_status" class="form-label">Resident Status</label>
                                <input id="resident_status" name="resident_status" class="form-control" readonly>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-8 col-sm-8">
                    <h1>Blotter History of Resident</h1>
                    
                    <div class="residentTable mt-3">
                        <table class="table table-hover align-middle" id="viewTable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">DEFENDANT</th>
                                    <th class="text-center">COMPLAINANT</th>
                                    <th class="text-center">ACCUSATION</th>
                                    <th class="text-center">DATE FILED</th>
                                    <th class="text-center">STATUS</th>
                                </tr>
                            </thead>
                            <tbody class="text-center"></tbody>
                        </table>
                    </div>
                    <!-- Table Container End -->
                </div>
            </div>
        </div>
    </main>
</div>


<script src="./app/app.js"></script>
<script src="./app/object-js/residenceView.js"></script>

<?php
?>