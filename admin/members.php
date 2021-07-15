<?php

/*
 * Manage Members page:
 * You can Add, edit and delete members from here
 * */

// Starting the session to remember the user
session_start();

// Checking if the session named by the username is set, welcome him or redirect to the login page (index.php)
if (isset($_SESSION['Username'])) {

    // include the initialize file
    include "init.php";

    // Checking the value of 'do' button and store it or set to manage
    $do = isset($_GET['do'])? $_GET['do'] : 'manage';

    // If the page is the manage page
    if ($do == 'manage') {
        // Manage page
    } elseif ($do == 'edit') {
        echo 'Welcome to the Edit page';
    } else {
        echo 'Error: no page';
    }

    include $tpl . "footer.php"; // Include the Footer file

    echo 'Welcome ' . $_SESSION['Username'];
} else {
    header('Location: index.php');
    exit();
}