<?php

session_start();
require_once 'config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $categoryId = $_POST['categoryId'];

    try {
        require_once 'dbh.inc.php';
        require_once 'model/deletecategory_model.php';
        deleteCategory($conn, $categoryId);
        header('Location: ../category.php');
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

