<?php

require_once 'config_session.inc.php';
require_once 'user_redirect.php';
require_once '../dbh.inc.php';
require_once 'model/addtocart_model.php';
require_once 'controller/addtocart_contr.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "You must be logged in to add items to the cart."]);
    exit;
}

$product_id = $_POST['productId'];
$user_id = $_SESSION['user_id'];

try {
    if (isProductExist($conn, $user_id, $product_id)) {
        cartUpdateProductQuantity($conn, $user_id, $product_id);
    } else {
        setProductToCart($conn, $user_id, $product_id);
    }

    $conn = null;
    $stmt = null;
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
echo json_encode(["success" => true, "message" => "Product added to cart!"]);
die();
