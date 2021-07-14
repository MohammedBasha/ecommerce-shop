<?php

// Checking the value of 'do' button and store it or set to manage
$do = isset($_GET['do'])? $_GET['do'] : 'manage';

// If the page is the main page
if ($do == 'manage') {
    echo 'Welcome to the main page<br>';
    echo '<a href="?do=add" title="Add Category">Add Category</a>';
} elseif ($do == 'add') {
    echo 'Welcome to the add page';
} elseif ($do == 'insert') {
    echo 'Welcome to the insert page';
} else {
    echo 'Error: no page';
}