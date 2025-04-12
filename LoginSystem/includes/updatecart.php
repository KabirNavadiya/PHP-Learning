<?php

require_once 'config_session.inc.php';
require_once 'user_redirect.php';
require_once '../dbh.inc.php';
require_once 'model/updatecart_model.php';
session_start();

$product_id = $_POST['productId'];
$cartProductId = $_POST['cartProductId'];
$action = $_POST['action'];
$user_id = $_SESSION['user_id'];
$response = ["success" => false, "message" => "Invalid data received."];

try {

    if (!$cartProductId || !$action || !$user_id) {
        echo json_encode($response);
        exit;
    }

    switch ($action) {
        case "increase":
            increaseUserProductQuantity($conn, $cartProductId, $user_id);
            break;

        case "decrease":
            decreaseUserProductQuantity($conn, $cartProductId, $user_id);
            $quantity = getProductQuantity($conn, $cartProductId);
            if ($quantity[0]['quantity'] < 1) {
                deletFromCart($conn, $cartProductId);
            }
            break;

        case "remove":
            deletFromCart($conn, $cartProductId);
            break;

        default:
            $response["message"] = "Invalid action.";
            echo json_encode($response);
            exit;
    }

    $response = ["success" => true, "message" => "Cart updated successfully!"];
} catch (PDOException $e) {
    $response["message"] = "Query failed: " . $e->getMessage();
}

$conn = null;
$stmt = null;
echo json_encode($response);
exit;
