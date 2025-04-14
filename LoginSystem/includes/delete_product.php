<?php

require_once 'config_session.inc.php';
require_once 'admin_redirect.php';
require_once '../dbh.inc.php';
require_once 'model/deleteproduct_model.php';
require_once 'model/editproduct_model.php';
session_start();

$productId = $_POST['productId'];

try {

    $oldimage = getOldImagePath($conn, $productId);
    deleteProduct($conn, $productId);
    unlink("uploads/" . $oldimage['image']);
    $conn = null;
    $stmt = null;
    die();
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
