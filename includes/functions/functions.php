<?php

function getCategories() {
    global $con;
    $stmt = $con->prepare("SELECT * FROM categories ORDER BY ID");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}