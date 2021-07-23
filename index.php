<?php

ob_start();

session_start();

// Set the page title
$pageTitle = 'Homepage';

// Adding the Page class
$pageClass = 'home-page';

// include the initialize file
include "init.php";

include $tpl . "footer.php"; // Include the Footer file

ob_end_flush();