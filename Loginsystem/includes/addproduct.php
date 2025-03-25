<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $productName = $_POST['productName'];
    $productCategory = $_POST['productCategory'];
    $productPrice = $_POST['productPrice'];
    $productDescription = $_POST['productDescription'];
    $productImage = $_POST['productImage'];

    try {
        require_once 'dbh.inc.php';
        require_once 'model/addproduct_model.php';
        require_once 'controller/addproduct_contr.php';

        $errors = [];
        if(isInputEmpty($productName, $productCategory, $productPrice, $productDescription, $productImage)){
            $errors["empty_input"] = "fill in all fields";
        }   

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_addproduct"] = $errors;
            header("Location: ../product.php");
            die();
        }


    }catch (PDOException $e) {
        die(" Query failed : " . $e->getMessage());
    }

}else{
    header('Location: ../product.php');
    die();
}