<?php

session_start();
require_once 'config_session.inc.php';
require_once 'admin_redirect.php';
require_once '../dbh.inc.php';
require_once 'model/editcategory_model.php';

$categoryId = $_POST['categoryId'];
$categoryName = $_POST['categoryName'];

try {
    updateCategory($conn, $categoryId,  $categoryName);

    $_SESSION['edit_success'] = "✅ Item Updated Successfully!";
    $conn = null;
    $stmt = null;
    header('Location: /category');
    die();
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
