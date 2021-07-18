<?php

/*
 * Manage Members page:
 * You can Add, edit and delete members from here
 * */

// Starting the session to remember the user
session_start();

// Page title
$pageTitle = 'Members';

// Adding the Page class
$pageClass = 'members-page';

// Checking if the session named by the username is set, welcome him or redirect to the login page (index.php)
if (isset($_SESSION['Username'])) {

    // include the initialize file
    include "init.php";

    // Checking the value of 'do' query value and store it or set to manage
    $do = isset($_GET['do']) ? $_GET['do'] : 'manage';

    // If the page is the manage page
    if ($do == 'manage') { // Manage page

        // include member's manage file
        include $members . "members-manage.php";

    } elseif ($do == 'add') { // Add members page

        // include member's add file
        include $members . "members-add.php";

    } elseif ($do == 'insert') { // Insert Page

        // include member's insert file
        include $members . "members-insert.php";

    } elseif ($do == 'edit') { // Edit page

        // include member's edit file
        include $members . "members-edit.php";

    } elseif ($do == 'update') { // update page that redirected from the edit page form's action

        // include member's update file
        include $members . "members-update.php";

    } elseif ($do == 'delete') { // Delete member's page

        // include member's delete file
        include $members . "members-delete.php";

    } elseif ($do == 'activate') { // Activate member's page

        // include member's activate file
        include $members . "members-activate.php";

    }

    include $tpl . "footer.php"; // Include the Footer file

} else {
    header('Location: index.php');
    exit();
}