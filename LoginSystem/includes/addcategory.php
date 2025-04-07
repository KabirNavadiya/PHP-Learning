<?php

session_start();
require_once 'config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header('Location: ../admin.php');
    die();
}
$categoryName = $_POST['categoryName'];

try {
    require_once 'dbh.inc.php';
    require_once 'model/addcategory_model.php';
    require_once 'controller/addcategory_contr.php';

    $errors = [];
    if (isInputEmpty($categoryName)) {
        $errors["empty_input"] = "fill in all fields";
    }

    if (doesExist($conn, $categoryName)) {

        $errors["category_exists"] = "Product already exist !";
    }

    if ($errors) {
        $_SESSION["errors_addcategory"] = $errors;
        header("Location: ../category.php");
        die();
    }
    setCategory($conn, $categoryName);

    $_SESSION['category_success'] = "✅ Category Added Successfully!";
    $conn = null;
    $stmt = null;
    header('Location: ../category.php');
    die();
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
