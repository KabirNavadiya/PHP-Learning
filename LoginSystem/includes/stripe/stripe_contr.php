<?php

// access variable from .env file
require_once '../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable("../../");
$dotenv->load();
$secret_key = $_ENV['STRIPE_SECRET_KEY'];

\Stripe\Stripe::setApiKey($secret_key);
function createStripeSession($cartItems)
{
    if (!$cartItems || empty($cartItems)) {
        return ["error" => "Cart is empty"];
    }

    $line_items = [];
    $totalAmount = 0;

    foreach ($cartItems as $item) {
        $discounted_price = $item['price'] - ($item['price'] * $item['discount']) / 100;
        $line_items[] = [
            'price_data' => [
                'currency' => 'inr',
                'product_data' => ['name' => $item['name']],
                'unit_amount' => intval($discounted_price * 100),
            ],
            'quantity' => intval($item['quantity']),
        ];
        $totalAmount += $discounted_price * $item['quantity'];
    }

    try {
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => 'http://myflipkart.com/paymentsuccess?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'http://myflipkart.com/cart',
        ]);

        return ['sessionUrl' => $session->url, 'totalAmount' => $totalAmount];
    } catch (Exception $e) {
        return ['error' => $e->getMessage()];
    }
}
