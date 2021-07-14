<?php

// Starting the session to remember the user
session_start();

session_unset(); // Unset the data

session_destroy(); // Destroy the data

header('Location: index.php'); // Redirect to the login page

exit(); // Terminate the script