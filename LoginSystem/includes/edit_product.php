<?php

require_once 'config_session.inc.php';
require_once 'admin_redirect.php';
require_once '../dbh.inc.php';
require_once 'model/editproduct_model.php';
require_once 'controller/editproduct_contr.php';
session_start();

$productId = $_POST['productId'];
$productName = $_POST['productName'];
$productCategory = $_POST['productCategory'];
$productPrice = $_POST['productPrice'];
$productDescription = $_POST['productDescription'];
$productImage = $_FILES['productImage'];

$extAllowed = ['jpg', 'jpeg', 'png', 'webp'];
$imageFileType = strtolower(pathinfo($productImage['name'], PATHINFO_EXTENSION));

if (!isFileEmpty($productImage)) {
    $mimeAllowed = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
    $mimeType = mime_content_type($productImage['tmp_name']);
}

try {
    $errors = [];
    if (empty($productId)) {
        $errors['empty_productid'] = "Please select a product first!";
    }
    if (!empty($productId)) {

        if ($productImage['size'] > 500 * 1024) {
            $errors['large_file'] = "maximum upload size 500kb";
        } else if (!is_numeric($productPrice) || $productPrice < 0) {
            $errors["invalid_price"] = "Enter a positive numeric value";
        } else if (!in_array($imageFileType, $extAllowed) || !in_array($mimeType, $mimeAllowed)) {
            $errors['image_error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    }

    if ($errors) {
        $_SESSION["errors_editproduct"] = $errors;
        header("Location: /admin");
        die();
    }
    if (!isFileEmpty($productImage)) {
        $oldImagePath = "uploads/" . getOldImagePath($conn, $productId)['image'];
        updateProduct($conn, $productId, $productName, $productCategory, $productPrice, $productDescription, $productImage);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
    } else {
        updateProduct($conn, $productId, $productName, $productCategory, $productPrice, $productDescription);
    }

    $_SESSION['edit_success'] = "✅ Item Updated Successfully!";
    $conn = null;
    $stmt = null;
    header('Location: /admin');
    die();
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
