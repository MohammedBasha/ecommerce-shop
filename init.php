<?php

// Database connection
include "admin/connect.php";

// Routes
$tpl = "includes/templates/"; // Templates directory
$lang = "includes/languages/"; // Language Directory
$func = "includes/functions/"; // Functions Directory
$members = "includes/pages/members/"; // Members Directory
$categories = "includes/pages/categories/"; // Categories Directory
$items = "includes/pages/items/"; // Items Directory
$comments = "includes/pages/comments/"; // Comments Directory
$css = "layout/css/"; // CSS Directory
$js = "layout/js/"; // JS Directory

// Include the important files
include 'admin/' . $func . "functions.php"; // The admin functions file
include $func . "functions.php"; // The front functions file
include $lang . "en.php"; // The English language file
include $tpl . "header.php"; // The Header file