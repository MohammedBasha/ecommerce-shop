<?php

// Database connection
include "connect.php";

// Routes
$tpl = "includes/templates/"; // Templates directory
$css = "layout/css/"; // CSS Directory
$js = "layout/js/"; // JS Directory
$lang = "includes/languages/"; // language Directory

// Include the important files
include $lang . "en.php"; // The English language file
include $tpl . "header.php"; // The Header file

// Checking if the page don't have $noNavbar variable, then add the navbar.php file in it
if (!isset($noNavbar)) {
    include $tpl . "navbar.php"; // The Navbar file
}