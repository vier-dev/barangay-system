<?php
session_start();
include './app/components/head.php';
include './api/config/database.php';

?>

<link rel="stylesheet" href="./app/assets/css/events.css">

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
                        <div class="sub-item"><a href="incomeReport.php">Stats Report</a></div>
                        <div class="sub-item"><a href="#" class="sub-active">Events</a></div>
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
            <h1>Events/Announcements</h1>

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


        <div class="container" id="page-container">
            <div class="row calendar_container">

                <!-- Calendar Container -->
                <div class="col-md-5 col-sm-5">
                    <div id="calendar"></div>
                </div>

                <!-- Schedule Form -->
                <div class="col-md-4 col-sm-4 calendar_form">
                    <div class="cardt rounded-0 shadow">
                        <div class="card-header bg-gradient" style="background-color: #6C9BCF; color: #fff;">
                            <h5 class="card-title p-2 d-flex justify-content-center">Schedule Events</h5>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <form action="serverScheduleAdd.php" method="POST" id="schedule-form">

                                    <input type="hidden" name="id" id="id" value="">

                                    <div class="form-group my-2">
                                        <label for="title" class="control-label">Title</label>
                                        <input type="text" class="form-control rounded-0" name="title" id="title" required>
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="description" class="control-label">Description</label>
                                        <textarea rows="4" class="form-control rounded-0" name="description" id="description" required></textarea>
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="start_date" class="control-label">Start Date</label>
                                        <input type="datetime-local" class="form-control rounded-0" name="start_date" id="start_date" required>
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="end_date" class="control-label">End Date</label>
                                        <input type="datetime-local" class="form-control rounded-0" name="end_date" id="end_date" required>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <button class="btn my-3" type="submit" form="schedule-form" style="background-color: #1B9C85; color: #fff;"><i class="fa fa-save"></i> Save Schedule</button>
                                <button class="btn btn-danger my-3" type="reset" form="schedule-form" style="background-color: #de105f; color: #fff;">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="announcements">

                <div class="row announcement_container">

                    <!-- Calendar Container -->
                    <div class="col-md-8 col-sm-8">
                        <div class="announcementTable">
                            <table class="table table-striped table-hover align-middle" id="announcementTable" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">TITLE</th>
                                        <th class="text-center">DESCRIPTION</th>
                                        <th class="text-center">DATE</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                            <!-- Table data end -->
                        </div>
                    </div>

                    <!-- Schedule Form -->
                    <div class="col-md-4 col-sm-4 announcement_form">
                        <div class="cardt rounded-0 shadow">
                            <div class="card-header bg-gradient" style="background-color: #F7D060; color: #363949;">
                                <h5 class="card-title p-2 d-flex justify-content-center">Announcements</h5>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                    <form method="POST" id="announcement-form">

                                        <div class="form-group my-2">
                                            <label for="announcement_title" class="control-label">Title</label>
                                            <input type="text" class="form-control rounded-0" name="announcement_title" id="announcement_title" required>
                                        </div>

                                        <div class="form-group my-2">
                                            <label for="announcement_description" class="control-label">Description</label>
                                            <textarea rows="3" class="form-control rounded-0" name="announcement_description" id="announcement_description" required></textarea>
                                        </div>

                                        <div class="form-group my-2">
                                            <label for="announcement_date" class="control-label">Date</label>
                                            <input type="datetime-local" class="form-control rounded-0" name="announcement_date" id="announcement_date" required>
                                        </div>

                                        <div class="text-center">
                                            <button class="btn my-3" id="insertBtn" type="submit" style="background-color: #1B9C85; color: #fff;">Add Announcement</button>
                                            <button class="btn btn-danger my-3" type="reset" style="background-color: #de105f; color: #fff;">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal shows when event clicked -->
        <!-- Event Details Modal -->
        <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0">
                    <div class="modal-header rounded-0">
                        <h5 class="modal-title">Schedule Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body rounded-0">
                        <div class="container-fluid">
                            <dl>
                                <dt class="text-muted">Title</dt>
                                <dd id="title" class="fw-bold fs-4"></dd>
                                <dt class="text-muted">Description</dt>
                                <dd id="description" class=""></dd>
                                <dt class="text-muted">Start Date </dt>
                                <dd id="start" class=""></dd>
                                <dt class="text-muted">End Date</dt>
                                <dd id="end" class=""></dd>
                            </dl>
                        </div>
                    </div>
                    <div class="modal-footer rounded-0">
                        <div class="text-end">
                            <button type="button" class="btn btn-primary" id="edit" data-id="">Edit</button>
                            <button type="button" class="btn btn-danger" id="delete" data-id="">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Event Details Modal -->
    </main>
    <!-- End of Main Content -->


    
    <?php 
        $schedules = $conn->query("SELECT * FROM `schedule_list`");
        $sched_res = [];
        foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
            $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_date']));
            $row['edate'] = date("F d, Y h:i A",strtotime($row['end_date']));
            $sched_res[$row['id']] = $row;
        }
    ?>

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
<script src="./app/object-js/events.js"></script>

<script> 
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>

<?php

?>