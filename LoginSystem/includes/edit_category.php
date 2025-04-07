<?php

session_start();
require_once 'config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header('Location: ../admin.php');
    die();
}

$categoryId = $_POST['categoryId'];
$categoryName = $_POST['categoryName'];

try {
    require_once 'dbh.inc.php';
    require_once 'model/editcategory_model.php';

    updateCategory($conn, $categoryId,  $categoryName);

    $_SESSION['edit_success'] = "✅ Item Updated Successfully!";
    $conn = null;
    $stmt = null;
    header('Location: ../category.php');
    die();
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
