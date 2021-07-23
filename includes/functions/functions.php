<?php

// Getting all the categories
function getCategories() {
    global $con;
    $stmt = $con->prepare("SELECT * FROM categories ORDER BY ID");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}

// Getting all the items of specific category
function getItems($catid) {
    global $con;
    $stmt = $con->prepare("SELECT * FROM items WHERE Cat_ID = ? ORDER BY ID");
    $stmt->execute([$catid]);
    $rows = $stmt->fetchAll();
    return $rows;
}

// Checking if the user's registered status
function checkUserStatus($user) {
    global $con;

    // Checking if the user exists in the database and RegStatus = 0
    $stmt = $con->prepare("SELECT Username, RegStatus
                            FROM users
                            WHERE Username = ?
                            AND RegStatus = 0");
    $stmt->execute([$user]);
    $rowCount = $stmt->rowCount();

    return $rowCount;
}