<?php

session_start();
require_once 'config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $productId = $_POST['productId'];

    try {
        require_once 'dbh.inc.php';
        require_once 'model/deleteproduct_model.php';
        deleteProduct($conn, $productId);
        header('Location: ../admin.php');
        $conn = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die(" Query failed : " . $e->getMessage());
    }
} else {
    header('Location: ../admin.php');
    die();
}

