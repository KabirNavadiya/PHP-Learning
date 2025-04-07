<?php
require_once '../dbh.inc.php';
require_once 'config_session.inc.php';
require_once 'model/order_model.php';

if (!isset($_POST['orderId'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No order ID provided.'
    ]);
}
$order_id = $_POST['orderId'];
$orderdetails = getOrderDetails($conn, $order_id);
if ($orderdetails) {
    echo json_encode([
        'success' => true,
        'order_details' => $orderdetails
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No order details found for this order.'
    ]);
}
