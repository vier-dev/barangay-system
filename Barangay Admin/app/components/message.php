<?php

//for register messages
if(isset($_SESSION['message-warning']))
{
    ?>
            <div class=" m-3 alert col-md-4 alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> <?= $_SESSION['message-warning']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php
    unset($_SESSION['message-warning']);
}

if(isset($_SESSION['message-success']))
{
    ?>
            <div class=" m-3 alert col-md-4 alert-success alert-dismissible fade show" role="alert">
                <strong>Congrats!</strong> <?= $_SESSION['message-success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php
    unset($_SESSION['message-success']);
}

if(isset($_SESSION['message-failed']))
{
    ?>
            <div class=" m-3 alert col-md-4 alert-danger alert-dismissible fade show" role="alert">
                <strong>Invalid!</strong> <?= $_SESSION['message-failed']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php
    unset($_SESSION['message-failed']);
}


?>


    