<?php

require_once '../dbh.inc.php';
require_once 'config_session.inc.php';
require_once 'model/order_model.php';
require_once 'user_redirect.php';

$response = ['success' => false, 'message' => 'No order ID provided.'];

if (isset($_POST['orderId']) && !empty($_POST['orderId'])) {
    $order_id = $_POST['orderId'];
    $orderdetails = getOrderDetails($conn, $order_id);

    if ($orderdetails) {
        $response = [
            'success' => true,
            'order_details' => $orderdetails
        ];
    } else {
        $response['message'] = 'No order details found for this order.';
    }
}
echo json_encode($response);
exit;
