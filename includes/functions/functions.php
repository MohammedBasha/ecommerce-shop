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

function redirectHome($msg, $url = null, $seconds = 3) {

    // checking if the url is given
    if ($url === null) {
        $url = 'index.php';
    } else {
        $url = isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : 'index.php';
    }

    echo $msg;
    echo '<div class="col-12 alert alert-info text-center">You will be redirected after ' . $seconds . ' seconds</div>';

    header("refresh:$seconds;url=$url");

    exit();
}

/*
 * Check items in the database
 * parameters:
 * $select: could be user / item / category
 * $from: table name to select from
 * $value: value of selected variable ($select)
 * */

function checkItem($select, $from, $value) {
    global $con;
    $stmt = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
    $stmt->execute([$value]);
    $count = $stmt->rowCount();
    return $count;
}

/*
 * Count items in the database
 * parameters:
 * $item: could be user / item / category
 * $from: table name to select from
 * */

function countItem($item, $from) {
    global $con;
    $stmt = $con->prepare("SELECT COUNT($item) FROM $from");
    $stmt->execute();
    return $stmt->fetchColumn();
}

/*
 * Get latest items in the database
 * parameters:
 * $select: could be user / item / category
 * $from: table name to select from
 * $limit: value of selected variable ($select)
 * */

function getLatest($select, $from, $order, $limit = 5) {
    global $con;
    $stmt = $con->prepare("SELECT $select FROM $from ORDER BY $order DESC LIMIT $limit");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}

/*
 * Get Categories
 * */

function getCategories() {
    global $con;
    $stmt = $con->prepare("SELECT * FROM categories ORDER BY ID");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}