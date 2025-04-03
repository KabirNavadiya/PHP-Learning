<?php


require_once '../config_session.inc.php';
require_once 'stripe_contr.php';
require_once '../dbh.inc.php';
require_once 'stripe_model.php';

header('Content-Type: application/json');
session_start();
$user_id = $_SESSION['user_id'];
$cartItems = getUserCartItems($conn, $user_id);
if (!isset($user_id)) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$response = createStripeSession($cartItems);

if (!$response) {
    echo json_encode(["error" => "Failed to create Stripe session"]);
} else {
    header("Location: " . $response['sessionUrl']);
}

