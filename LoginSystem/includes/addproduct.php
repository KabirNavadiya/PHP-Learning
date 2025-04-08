<?php

session_start();
require_once 'config_session.inc.php';
require_once 'admin_redirect.php';


$productName = $_POST['productName'];
$productCategory = $_POST['productCategory'];
$productPrice = $_POST['productPrice'];
$productDescription = $_POST['productDescription'];
$productImage = $_FILES['productImage'];
$discount = isset($_POST['discount']) ? (int)$_POST['discount'] : 0;

try {
    require_once '../dbh.inc.php';
    require_once 'model/addproduct_model.php';
    require_once 'controller/addproduct_contr.php';

    $errors = [];
    if(empty($productName)){
        $errors['empty_productname'] = "please enter product name";
    }
    if(empty($productCategory)){
        $errors['empty_productcategory'] = "please enter product category";
    }
    if(empty($productDescription)){
        $errors['empty_productdescription'] = "please enter product description";
    }
    if(empty($productPrice)){
        $errors['empty_productprice'] = "please enter product price";
    }
    if(!isset($productImage['error']) || $productImage['error'] === UPLOAD_ERR_NO_FILE){
        $errors['empty_productimage'] = "please enter product image";
    }

    if(!empty($productName) && !empty($productCategory) && !empty($productDescription) && !empty($productPrice) && !empty($productImage)){

        if (!is_numeric($productPrice) || $productPrice <0) {
            $errors["invalid_price"] = "Enter a positive numeric value";
        }
        if (doesExist($conn, $productName)) {
            $errors["product_exists"] = "Product already exist !";
        }
        if (!is_numeric($discount)) {
            $errors['invalid_discount'] = "enter numeric value";
        }
        if ($discount < 0 || $discount > 50 ){
            $errors['discount_range'] = "discount range must be 0-50";
        }
    }
        
    if ($errors) {
        $_SESSION["errors_addproduct"] = $errors;
        header("Location: /product");
        die();
    }
    setProduct($conn, $productName, $productCategory, $productPrice, $productDescription, $productImage, $discount);

    $_SESSION['product_success'] = "✅ Item Added Successfully!";
    $conn = null;
    $stmt = null;
    header('Location: /product');
    die();
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
