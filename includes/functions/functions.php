<?php

function getCategories() {
    global $con;
    $stmt = $con->prepare("SELECT * FROM categories ORDER BY ID");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}

function getItems($catid) {
    global $con;
    $stmt = $con->prepare("SELECT * FROM items WHERE Cat_ID = ? ORDER BY ID");
    $stmt->execute([$catid]);
    $rows = $stmt->fetchAll();
    return $rows;
}