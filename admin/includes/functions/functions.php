<?php

/*
 * Echo the page title if specified in the page $pageTitle or default in another pages
 * */

function getTitle() {
    global $pageTitle;

    echo isset($pageTitle)? $pageTitle : 'Default';
}

/*
 * Redirect function
 * Parameters:
 * $successMsg: prints the success message
 * $errorMsg: prints the error message
 * $seconds: seconds before redirecting
 * */

function redirectHome($successMsg = '', $errorMsg = '', $seconds = 3) {
    // Checking if the success argument not empty string
    if (!empty($successMsg)) {
        echo '<div class="col-12 alert alert-success text-center mt-5 mb-3">' . $successMsg . '</div>';
        echo '<div class="col-12 alert alert-info text-center">You will be redirected to members page after ' . $seconds . ' seconds</div>';
        header("refresh:$seconds;url=members.php");
    }

    // Checking if the error argument not empty string
    if (!empty($errorMsg)) {
        echo '<div class="col-12 alert alert-danger text-center mt-5 mb-3">' . $errorMsg . '</div>';
        echo '<div class="col-12 alert alert-info text-center">You will be redirected to Home page after ' . $seconds . ' seconds</div>';
        header("refresh:$seconds;url=index.php");
    }

    exit();
}