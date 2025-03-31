<?php

session_start();
require_once 'config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $categoryId = $_POST['categoryId'];
    $categoryName = $_POST['categoryName'];

    try {
        require_once 'dbh.inc.php';
        require_once 'model/editcategory_model.php';

        updateCategory($conn, $categoryId,  $categoryName);


        $_SESSION['edit_success'] = "✅ Item Updated Successfully!";
        header('Location: ../category.php');

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
