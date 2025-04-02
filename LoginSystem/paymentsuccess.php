<?php

require_once 'vendor/stripe/stripe-php/init.php';
require_once 'includes/stripe/config.php';
require_once 'includes/dbh.inc.php';
require_once 'includes/model/order_model.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/model/addtocart_model.php';


if (!isset($_GET['session_id'])) {
    header("Location: cart.php");
    exit;
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit;
}
\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
try {
    $session = \Stripe\Checkout\Session::retrieve($_GET['session_id']);
    

    print_r($details);
    if ($session->payment_status === "paid") {
        
        $transaction_id = $session->id;
        $user_id = $_SESSION['user_id'];
        createOrder($conn,$user_id, $transaction_id, $session->amount_total / 100);
        $orderid = getOrderId($conn,$transaction_id);
        $details = getDetailsAboutOrder($conn,$user_id);        
        foreach($details as $detail){
            setOrderDetails($conn, $orderid['order_id'], $detail['product_id'], $detail['product_image'], $detail['product_name'], $detail['product_price'],$detail['quantity']);
        }
        clearUserCart($conn,$user_id);
      
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            showLoader("Payment successful! Redirecting...");
            setTimeout(function() {
                    window.location.href = "index.php";
            }, 2000);

        });

        function showLoader(message) {
            let LoaderContainer = document.createElement("div");
            LoaderContainer.innerHTML = `
                <div style="position: fixed; top: 50%; right: 50%; z-index: 9999">
                    <div class="loader" style="
                        border: 16px solid #f3f3f3;
                        border-radius: 50%;
                        border-top: 16px solid #3498db;
                        width: 60px;
                        height: 60px;
                        -webkit-animation: spin 2s linear infinite;
                        animation: spin 2s linear infinite;
                    "></div>
                </div>
                <style>
                @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
                }

                @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
                }
            </style>
            `;
            document.body.appendChild(LoaderContainer);
        }
    </script>';


    } else {
        header("Location: cart.php");
    }
} catch (Exception $e) {
    header("Location: cart.php?error=" . urlencode($e->getMessage()));
}
// exit;
?>
