<?php

// Getting all from tableName
function getAllFrom($tblName, $order = NULL) {
    if ($order == NULL) {
        $sql = '';
    } else {
        $sql = 'ORDER BY ' . $order . ' DESC';
    }
    global $con;
    $getAll = $con->prepare("SELECT * FROM $tblName $sql");
    $getAll->execute();
    $all = $getAll->fetchAll();
    return $all;
}

// Getting all the categories
function getCategories() {
    global $con;
    $stmt = $con->prepare("SELECT * FROM categories ORDER BY ID");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}

// Getting all the items of specific category
function getItems($where = 'Cat_ID', $value = 1, $approve = NULL) {

    $sql = $approve == NULL? 'AND Approve = 1' : NULL;

    global $con;
    $stmt = $con->prepare("SELECT * FROM items WHERE $where = ? $sql ORDER BY ID");
    $stmt->execute([$value]);
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