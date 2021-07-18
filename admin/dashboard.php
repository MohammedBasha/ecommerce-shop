<?php

// Starting the session to remember the user
session_start();

// checking if the session named by the username is set, welcome him or redirect to the login page (index.php)
if (isset($_SESSION['Username'])) {

    // Set the page title
    $pageTitle = 'Dashboard';

    // Adding the Page class
    $pageClass = 'dashboard-page';

    // include the initialize file
    include "init.php";
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">Welcome <?php echo $_SESSION['Username']; ?></div>
        </div>
    </div>
    <?php
    include $tpl . "footer.php"; // Include the Footer file
} else {
    header('Location: index.php');
    exit();
}
?>