<?php

session_start();
require_once 'config_session.inc.php';
require_once 'admin_redirect.php';

$productId = $_POST['productId'];
$productName = $_POST['productName'];
$productCategory = $_POST['productCategory'];
$productPrice = $_POST['productPrice'];
$productDescription = $_POST['productDescription'];
$productImage = $_FILES['productImage'];

try {
    require_once '../dbh.inc.php';
    require_once 'model/editproduct_model.php';
    require_once 'controller/editproduct_contr.php';

    if (!is_numeric($productPrice) || $productPrice <0) {
        $errors["invalid_price"] = "Enter a positive numeric value";
    }
    
    if ($errors) {
        $_SESSION["errors_aeditproduct"] = $errors;
        header("Location: /admin");
        die();
    }
    if (isFileEmpty($productImage)) {
        updateWithoutImage($conn, $productId,  $productName,  $productCategory,  $productPrice,  $productDescription);
    } else {
        $oldImage = getOldImagePath($conn,$productId);
        updateWithImage($conn, $productId, $productName, $productCategory, $productPrice, $productDescription, $productImage);
        unlink("uploads/" . $oldImage['image']);
    }

    $_SESSION['edit_success'] = "✅ Item Updated Successfully!";
    $conn = null;
    $stmt = null;
    header('Location: /admin');
    die();
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
