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

                <div class="item"><a href="residence.php">
                        <span class="material-icons-sharp">
                            home
                        </span>Residence</a>
                </div>

                <div class="item"><a href="#"  class="active">
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
            <h1>View Inquiry Information</h1>

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
                    <li class="breadcrumb-item"><a href="documents.php">Docs/Query Section</a></li>
                    <li class="breadcrumb-item breadcrumb-active" aria-current="page">View Inquiry Information</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-4 col-sm-4">

                    <form action="documentsPrint.php" id="viewForm" target="_blank" method="POST">

                        <div class="row d-flex align-items-center justify-content-center">
                            <div class="mb-4 col-md-3 col-sm-3">
                                <img id="preview_img" class="preview_img" src="./app/assets/images/user-preview.png">
                            </div>
                        </div>

                        <input type="hidden" name="id" id="id">

                        <div class="mb-3">
                            <label for="name" class="form-label">Resident's Name</label><br>
                            <input type="text" class="form-control " name="name" id="name" readonly>
                        </div>
                        
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-6">
                                <label for="subject" class="form-label">Subject for Inquiry</label>
                                <input class="form-control " name="subject" id="subject" readonly>
                            </div>

                            <div class="mb-3 col-md-6 col-sm-6">
                                <label for="date" class="form-label">Date Filed</label>
                                <input id="date" name="date" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-6">
                                <label for="purpose" class="form-label">Inquiry Purpose</label>
                                <input class="form-control " name="purpose" id="purpose" readonly>
                            </div>

                            <div class="mb-3 col-md-6 col-sm-6">
                                <label for="status" class="form-label">Inquiry Status</label>
                                <input class="form-control " name="status" id="status" readonly>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="printBtn"><i class="fa fa-print px-2"></i>Print Inquiry</button>
                    </form>
                </div>

                <div class="col-md-8 col-sm-8">
                    <h1>Inquiry History of Resident</h1>

                    <div class="residentTable mt-3">
                        <table class="table table-hover align-middle" id="viewTable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">NAME</th>
                                    <th class="text-center">SUBJECT</th>
                                    <th class="text-center">PURPOSE</th>
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
<script src="./app/object-js/documentsView.js"></script>

<?php
?>