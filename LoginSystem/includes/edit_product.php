<?php

session_start();
require_once 'config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header('Location: ../admin.php');
    die();
}

$productId = $_POST['productId'];
$productName = $_POST['productName'];
$productCategory = $_POST['productCategory'];
$productPrice = $_POST['productPrice'];
$productDescription = $_POST['productDescription'];
$productImage = $_FILES['productImage'];

try {
    require_once 'dbh.inc.php';
    require_once 'model/editproduct_model.php';
    require_once 'controller/editproduct_contr.php';

    if (isFileEmpty($productImage)) {
        updateWithoutImage($conn, $productId,  $productName,  $productCategory,  $productPrice,  $productDescription);
    } else {
        updateWithImage($conn, $productId, $productName, $productCategory, $productPrice, $productDescription, $productImage);
    }

    $_SESSION['edit_success'] = "✅ Item Updated Successfully!";
    $conn = null;
    $stmt = null;
    header('Location: ../admin.php');
    die();
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
