<?php

ob_start();

// Starting the session to remember the user
session_start();

// Page title
$pageTitle = 'Comments';

// Adding the Page class
$pageClass = 'comments-page';

// Checking if the session named by the username is set, welcome him or redirect to the login page (index.php)
if (isset($_SESSION['Username'])) {

    // include the initialize file
    include "init.php";

    // Checking the value of 'do' query value and store it or set to manage
    $do = isset($_GET['do']) ? $_GET['do'] : 'manage';

    // If the page is the manage page
    if ($do == 'manage') { // Manage page

        // include comments's manage file
        include $comments . "comments-manage.php";

    } elseif ($do == 'edit') { // Edit page

        // include comments's edit file
        include $comments . "comments-edit.php";

    } elseif ($do == 'update') { // update page that redirected from the edit page form's action

        // include comments's update file
        include $comments . "comments-update.php";

    } elseif ($do == 'delete') { // Delete member's page

        // include comments's delete file
        include $comments . "comments-delete.php";

    } elseif ($do == 'approve') { // Approve member's page

        // include comment's approve file
        include $comments . "comments-approve.php";

    }

    include $tpl . "footer.php"; // Include the Footer file

} else {
    header('Location: index.php');
    exit();
}

ob_end_flush();