<?php

session_start();
require_once 'config_session.inc.php';
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header('Location: ../admin.php');
    die();
}

$productId = $_POST['productId'];

try {
    require_once 'dbh.inc.php';
    require_once 'model/deleteproduct_model.php';

    $query = "SELECT image FROM products where id = :id;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $productId);
    $stmt->execute();
    $oldimage = $stmt->fetch(PDO::FETCH_ASSOC);
    
    deleteProduct($conn, $productId);
    unlink("uploads/" . $oldimage['image']);
    $conn = null;
    $stmt = null;
    die();
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
