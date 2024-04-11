<?php
session_start();
include './app/components/head.php'

?>

<link rel="stylesheet" href="./app/assets/css/blotter.css">

<div class="top-bar">
    <div class="container d-flex justify-content-between align-items-center text-align-center">
        <h1>Blotter Archives</h1>

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
</div>


<div class="container">

    <main>
        <div>

            <button type="button" class="btn btn-secondary mb-4">
                <a href="blotter.php">
                    <div class="d-flex align-items-center" style="color:white;">
                        <span class="material-icons-sharp px-2"> arrow_back </span> Back
                    </div>
                </a>
            </button>

            <table class="table table-striped table-hover align-middle" id="archiveTable" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center">BLOTTER ID</th>
                        <th class="text-center">DEFENDANT</th>
                        <th class="text-center">COMPLAINANT'S NAME</th>
                        <th class="text-center">ACCUSATION</th>
                        <th class="text-center">DATE FILED</th>
                        <th class="text-center">STATUS</th>
                    </tr>
                </thead>
                <tbody class="text-center"></tbody>
            </table>
            <!-- Table data end -->
        </div>
    </main>
</div>

<script src="./app/app.js"></script>

<script src="./app/object-js/blotter.js"></script>

<?php

?>