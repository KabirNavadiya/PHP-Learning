<?php

session_start();
require_once '../../vendor/stripe/stripe-php/init.php';

require_once 'config.php';
require_once 'stripe_model.php';


\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
function createStripeSession($user_id)
{
    $cartItems = getUserCartItems($user_id);

    if (!$cartItems || empty($cartItems)) {
        return ["error" => "Cart is empty"];
    }

    $line_items = [];
    $totalAmount = 0;

    foreach ($cartItems as $item) {
        $discounted_price = $item['price'] - ($item['price'] * $item['discount']) / 100;
        if ($discounted_price <= 0) {
            return ["error" => "Invalid product price"];
        }
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
            'success_url' => 'http://myapp.com/paymentsuccess.php?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'http://myapp.com/cart.php',
        ]);

        return ['sessionId' => $session->id, 'totalAmount' => $totalAmount];
    } catch (Exception $e) {
        return ['error' => $e->getMessage()];
    }
}
