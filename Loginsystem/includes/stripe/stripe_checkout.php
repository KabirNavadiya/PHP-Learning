<?php
require_once '../config_session.inc.php';
require_once 'stripe_contr.php';


header('Content-Type: application/json');
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$response = createStripeSession($_SESSION['user_id']);

if (!$response) {
    echo json_encode(["error" => "Failed to create Stripe session"]);
} else {
    echo json_encode($response);
}

