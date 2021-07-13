<?php

// Starting the session to remember the user
session_start();

// checking if the session named by the username is set, welcome him or redirect to the login page (index.php)
if (isset($_SESSION['Username'])) {
    echo 'Welcome ' . $_SESSION['Username'];
} else {
    header('Location: index.php');
    exit();
}