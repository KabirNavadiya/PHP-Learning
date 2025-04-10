<?php

session_start();
require_once 'config_session.inc.php';
require_once 'admin_redirect.php';

$categoryId = $_POST['categoryId'];

try {
    require_once '../dbh.inc.php';
    require_once 'model/deletecategory_model.php';
    deleteCategory($conn, $categoryId);
    $conn = null;
    $stmt = null;
    header('Location: /category');
    die();
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
