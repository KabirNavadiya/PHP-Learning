<?php

session_start();
require_once 'config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $productName = $_POST['productName'];
    $productCategory = $_POST['productCategory'];
    $productPrice = $_POST['productPrice'];
    $productDescription = $_POST['productDescription'];
    $productImage = $_FILES['productImage'];
    $discount = $_POST['discount'];

    try {
        require_once 'dbh.inc.php';
        require_once 'model/addproduct_model.php';
        require_once 'controller/addproduct_contr.php';

        $errors = [];
        if (isInputEmpty($productName, $productCategory, $productPrice, $productDescription, $productImage)) {
            $errors["empty_input"] = "fill in all fields";
        }

        if (doesExist($conn, $productName)) {
            $errors["product_exists"] = "Product already exist !";
        }

        if ($errors) {
            $_SESSION["errors_addproduct"] = $errors;
            header("Location: ../product.php");
            die();
        }
        setProduct($conn, $productName, $productCategory, $productPrice, $productDescription, $productImage,$discount);

        $_SESSION['product_success'] = "✅ Item Added Successfully!";
        header('Location: ../product.php');

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
