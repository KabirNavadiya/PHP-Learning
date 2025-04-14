<?php

require_once 'config_session.inc.php';
require_once 'admin_redirect.php';
require_once '../dbh.inc.php';
require_once 'model/deletecategory_model.php';
session_start();

$categoryId = $_POST['categoryId'];

try {
    deleteCategory($conn, $categoryId);
    $conn = null;
    $stmt = null;
    header('Location: /category');
    die();
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
