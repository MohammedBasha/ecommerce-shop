<?php

ob_start();

// Starting the session to remember the user
session_start();

// Page title
$pageTitle = 'Items';

// Adding the Page class
$pageClass = 'items-page';

// Checking if the session named by the username is set, welcome him or redirect to the login page (index.php)
if (isset($_SESSION['Username'])) {

    // include the initialize file
    include "init.php";

    // Checking the value of 'do' query value and store it or set to manage
    $do = isset($_GET['do']) ? $_GET['do'] : 'manage';

    // If the page is the manage page
    if ($do == 'manage') { // Manage page

        // include item's manage file
        include $items . "items-manage.php";

    } elseif ($do == 'add') { // Add items page

        // include item's add file
        include $items . "items-add.php";

    } elseif ($do == 'insert') { // Insert Page

        // include item's insert file
        include $items . "items-insert.php";

    } elseif ($do == 'edit') { // Edit page

        // include item's edit file
        include $items . "items-edit.php";

    } elseif ($do == 'update') { // update page that redirected from the edit page form's action

        // include item's update file
        include $items . "items-update.php";

    } elseif ($do == 'delete') { // Delete item's page

        // include item's delete file
        include $items . "items-delete.php";

    } elseif ($do == 'approve') { // Approve items's page

        // include item's activate file
        include $items . "items-approve.php";

    }

    include $tpl . "footer.php"; // Include the Footer file

} else {
    header('Location: index.php');
    exit();
}

ob_end_flush();