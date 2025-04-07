<?php
session_start();
require_once 'config_session.inc.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    die();
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "You must be logged in to add items to the cart."]);
    exit;
}

$product_id = $_POST['productId'];
$user_id = $_SESSION['user_id'];

try {
    require_once 'dbh.inc.php';
    require_once 'model/addtocart_model.php';
    require_once 'controller/addtocart_contr.php';

    if (isProductExist($conn, $user_id, $product_id)) {
        // $errors["product_exists"] = "Product already exist in cart!";
        updateProductQuantity($conn, $user_id, $product_id);
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
