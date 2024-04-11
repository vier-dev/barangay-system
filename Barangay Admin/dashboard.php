<?php
session_start();
include './api/config/database.php';
include './app/components/head.php';

?>
<link rel="stylesheet" href="./app/assets/css/dashboard.css">

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

                <div class="item"><a href="#" class="active">
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
            <h1>Dashboard</h1>

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
        <div class="analyse">

            <div class="sales">
                <div class="status">
                    <div class="info">
                        <h3>Barangay Income</h3>
                        <?php
                            $queries = "SELECT SUM(document_fee) as total_fee FROM `queries` WHERE document_fee IS NOT NULL";
                            $queries_run = mysqli_query($conn, $queries);

                            $row = mysqli_fetch_assoc($queries_run);
                            if($total = $row['total_fee']) echo '<h1> $'.$total.'.00 </h1>';
                            else echo '<h1> Php 0 </h1>';
                            
                        ?>
                    </div>
                    <div class="progresss">
                        <svg>
                            <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="percentage">
                            <p>+45%</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="queries">
                <div class="status">
                    <div class="info">
                        <h3>Queries</h3>
                        <?php
                            $queries = "SELECT * FROM `queries`";
                            $queries_run = mysqli_query($conn, $queries);

                            if($total = mysqli_num_rows($queries_run)) echo '<h1>'.$total.' </h1>';
                            else echo '<h1> 0 </h1>';
                        ?>
                    </div>
                    <div class="progresss">
                        <svg>
                            <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="percentage">
                            <p>+81%</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="blotter">
                <div class="status">
                    <div class="info">
                        <h3>Blotters</h3>
                        <?php
                            $blotter = "SELECT * FROM `blotter`";
                            $blotter_run = mysqli_query($conn, $blotter);

                            if($total = mysqli_num_rows($blotter_run)) echo '<h1> '.$total.' </h1>';
                            else echo '<h1> 0 </h1>';
                        ?>
                    </div>
                    <div class="progresss">
                        <svg>
                            <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="percentage">
                            <p>-48%</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="searches">
                <div class="status">
                    <div class="info">
                        <h3>Total Residents</h3>
                        <?php
                            $resident = "SELECT * FROM `residents`";
                            $resident_run = mysqli_query($conn, $resident);

                            if($total = mysqli_num_rows($resident_run)) echo '<h1> '.$total.' </h1>';
                            else echo '<h1> 0 </h1>';
                        ?>
                    </div>
                    <div class="progresss">
                        <svg>
                            <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="percentage">
                            <p>+21%</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End of Analyses -->

        <div class="content">
            <!-- Announcements Section -->
            <div class="announcement">
                <h2>Barangay Announcements</h2>
                <div class="announcementTable">
                    <table class="table table-striped table-hover align-middle" id="announcementTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">DATE</th>
                                <th class="text-center">TITLE</th>
                            </tr>
                        </thead>
                        <tbody class="text-center"></tbody>
                    </table>
                    <!-- Table data end -->
                </div>
            </div>
            <!-- End of Announcements Section -->

            <!-- Queries Table -->
            <div class="query">
                <h2>Pending & On Process Queries</h2>
                <div class="documentTable">
                    <table class="table table-striped table-hover align-middle" id="documentTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">DATE FILED</th>
                                <th class="text-center">NAME</th>
                                <th class="text-center">SUBJECT</th>
                                <th class="text-center">PURPOSE</th>
                                <th class="text-center">STATUS</th>
                            </tr>
                        </thead>
                        <tbody class="text-center"></tbody>
                    </table>
                    <!-- Table data end -->
                </div>
            </div>
            <!-- End of Queries Table -->
        </div>


    </main>
    <!-- End of Main Content -->

</div>

<script src="./app/app.js"></script>
<script src="./app/object-js/dashboard.js"></script>

<?php

?>