<?php
session_start();
include './app/components/head.php';
include './api/config/database.php';

?>

<link rel="stylesheet" href="./app/assets/css/incomeReport.css">

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
                    <a class="sub-btn active">
                        <span class="material-icons-sharp">
                            report_gmailerrorred
                        </span>Reports
                        <span class="material-icons-sharp dropdown">
                            expand_more
                        </span>
                    </a>

                    <div class="sub-menu">
                        <div class="sub-item"><a href="#" class="sub-active">Stats Report</a></div>
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
            <h1>Statistic Report</h1>

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

        <div class="documents">

            <!--Document chart-->
            <div class="d-flex justify-content-center">

                <?php
                    $doughnut_data = array();
                    $doughnut_count = 0;

                    $doughnut_run = mysqli_query($conn, 'SELECT subject, COUNT(*) as total FROM `queries` GROUP BY subject');

                    while($row = mysqli_fetch_array($doughnut_run)) {
                        $doughnut_data[$doughnut_count]['label'] = $row['subject'];
                        $doughnut_data[$doughnut_count]['y'] = $row['total'];
                        $doughnut_count=$doughnut_count+1;
                    }
                ?>

                <div id="chartDoughnut" style="height: 210px; width: 100%;"></div>
            </div>

            <!--Social Status chart-->
            <div class="d-flex justify-content-center">

                <?php
                    $socialData = array();
                    $social_count = 0;

                    $social_run = mysqli_query($conn, 'SELECT social_status, COUNT(*) as total FROM `residents` GROUP BY social_status');

                    while($row = mysqli_fetch_array($social_run)) {
                        $socialData[$social_count]['label'] = $row['social_status'];
                        $socialData[$social_count]['y'] = $row['total'];
                        $social_count=$social_count+1;
                    }
                ?>
                
                <div id="chartSocialStat" style="height: 210px; width: 100%;"></div>
            </div>
        </div>

        <div class="documents">

            <!--Blotter chart-->
            <div class="d-flex justify-content-center">

                    <?php
                        $blotterData = array();
                        $blotter_count = 0;

                        $blotter_run = mysqli_query($conn, 'SELECT date_filed, COUNT(*) as total FROM `blotter` GROUP BY date_filed');

                        while($row = mysqli_fetch_array($blotter_run)) {
                            $blotterData[$blotter_count]['label'] = $row['date_filed'];
                            $blotterData[$blotter_count]['y'] = $row['total'];
                            $blotter_count=$blotter_count+1;
                        }
                    ?>

                    <div id="chartContainer" style="height: 210px; width: 100%;"></div>
            </div>

            <!--Resident Status chart-->
            <div class="d-flex justify-content-center">

                <?php
                    $statusData = array();
                    $status_count = 0;

                    $status_run = mysqli_query($conn, 'SELECT resident_status, COUNT(*) as total FROM `residents` GROUP BY resident_status');

                    while($row = mysqli_fetch_array($status_run)) {
                        $statusData[$status_count]['label'] = $row['resident_status'];
                        $statusData[$status_count]['y'] = $row['total'];
                        $status_count=$status_count+1;
                    }
                ?>

                <div id="chartStatus" style="height: 210px; width: 100%;"></div>
            </div>

        </div>
    </main>
    <!-- End of Main Content -->
</div>

<script src="./app/app.js"></script>

<script>
    window.onload = function() {
    
        
    var documentChart = new CanvasJS.Chart("chartDoughnut", {
        animationEnabled: true,
        theme: "light2",
        title:{
            text: "Most Requested Documents"
        },
        data: [{
            type: "doughnut",
            indexLabel: "{symbol} - {y}",
            yValueFormatString: "#,##0",
            showInLegend: true,
            legendText: "{label}",
            dataPoints: <?php echo json_encode($doughnut_data, JSON_NUMERIC_CHECK); ?>
        }]
    });
    documentChart.render();
    

    var socialChart = new CanvasJS.Chart("chartSocialStat", {
        animationEnabled: true,
        theme: "light2",
        title:{
            text: "Social Status of Residents in Barangay"
        },
        data: [{
            type: "column",
            yValueFormatString: "Mix Gender; based only on Social Status",
            dataPoints: <?php echo json_encode($socialData, JSON_NUMERIC_CHECK); ?>
        }]
    });
    socialChart.render();


    var blotterChart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title:{
            text: "Blotters filed in Barangay based on Day"
        },
        data: [{
            type: "spline",
            markerSize: 5,
            xValueFormatString: "MMMM",
            xValueType: "dateTime",
            dataPoints: <?php echo json_encode($blotterData, JSON_NUMERIC_CHECK); ?>
        }]
    });
    blotterChart.render();


    var residentChart = new CanvasJS.Chart("chartStatus", {
        animationEnabled: true,
        theme: "light2",
        title:{
            text: "Resident Status in Barangay"
        },
        data: [{
            type: "doughnut",
            indexLabel: "{symbol} - {y}",
            yValueFormatString: "",
            showInLegend: true,
            legendText: "{label}",
            dataPoints: <?php echo json_encode($statusData, JSON_NUMERIC_CHECK); ?>
        }]
    });
    residentChart.render();
}
</script>

<?php

?>