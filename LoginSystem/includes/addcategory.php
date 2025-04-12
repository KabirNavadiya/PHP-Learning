<?php

require_once 'config_session.inc.php';
require_once 'admin_redirect.php';
require_once '../dbh.inc.php';
require_once 'model/addcategory_model.php';
require_once 'controller/addcategory_contr.php';
session_start();

$categoryName = $_POST['categoryName'];

try {
    $errors = [];
    if (isInputEmpty(categoryName: $categoryName)) {
        $errors["empty_input"] = "please enter category name";
    }
    if (doesExist($conn, $categoryName)) {
        $errors["category_exists"] = "Product already exist !";
    }

    if ($errors) {
        $_SESSION["errors_addcategory"] = $errors;
        header("Location: /category");
        die();
    }
    setCategory($conn, $categoryName);

    $_SESSION['category_success'] = "✅ Category Added Successfully!";
    $conn = null;
    $stmt = null;
    header('Location: /category');
    die();
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
