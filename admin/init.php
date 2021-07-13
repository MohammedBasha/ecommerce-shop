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