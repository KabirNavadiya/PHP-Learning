<?php
session_start();
require_once 'config_session.inc.php';
require_once 'user_redirect.php';

$product_id = $_POST['productId'];
$cartProductId = $_POST['cartProductId'];
$action = $_POST['action'];
$user_id = $_SESSION['user_id'];

try {
    require_once '../dbh.inc.php';
    require_once 'model/updatecart_model.php';

    if (!$cartProductId || !$action || !$user_id) {
        echo json_encode(["success" => false, "message" => "Invalid data received."]);
        exit;
    }
    if ($action === "increase") {
        increaseUserProductQuantity($conn, $cartProductId, $user_id);
    } else if ($action === "decrease") {
        decreaseUserProductQuantity($conn, $cartProductId, $user_id);
        $quantity = getProductQuantity($conn, $cartProductId);
        if ($quantity[0]['quantity'] < 1) {
            deletFromCart($conn, $cartProductId);
        }
    } else if ($action === "remove") {
        deletFromCart($conn, $cartProductId);
    }
    $conn = null;
    $stmt = null;
    $response = ["success" => true, "message" => "Cart updated successfully!"];
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
echo json_encode($response);
die();
