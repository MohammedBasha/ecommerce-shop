<?php

ob_start();

// Starting the session to remember the user
session_start();

// Page title
$pageTitle = 'Categories';

// Adding the Page class
$pageClass = 'categories-page';

// Checking if the session named by the username is set, welcome him or redirect to the login page (index.php)
if (isset($_SESSION['Username'])) {

    // include the initialize file
    include "init.php";

    // Checking the value of 'do' query value and store it or set to manage
    $do = isset($_GET['do']) ? $_GET['do'] : 'manage';

    // If the page is the manage page
    if ($do == 'manage') { // Manage page

        // include categories's manage file
        include $categories . "categories-manage.php";

    } elseif ($do == 'add') { // Add page

        // include categories's add file
        include $categories . "categories-add.php";

    } elseif ($do == 'insert') { // Insert Page

        // include categories's insert file
        include $categories . "categories-insert.php";

    } elseif ($do == 'edit') { // Edit page

        // include categories's edit file
        include $categories . "categories-edit.php";

    } elseif ($do == 'update') { // update page that redirected from the edit page form's action

        // include categories's update file
        include $categories . "categories-update.php";

    } elseif ($do == 'delete') { // Delete page

        // include categories's delete file
        include $categories . "categories-delete.php";

    }

    include $tpl . "footer.php"; // Include the Footer file

} else {
    header('Location: index.php');
    exit();
}

ob_end_flush();