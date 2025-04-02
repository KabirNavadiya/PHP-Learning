<?php
session_start();
require_once 'dbh.inc.php';
require_once 'model/addtocart_model.php'; // Ensure this file has getAllUserCartProducts()

$user_id = $_SESSION['user_id'] ?? null;
$total_price =  0;
$cart_html = "";
if (!$user_id) {
    echo json_encode([
        "cart_html" => $cart_html,
        "discounted_total_price" => $discounted_total_price ?? 0,
    ]);
    exit;
}

$userCartProducts = getAllUserCartProducts($conn, $user_id);

foreach ($userCartProducts as $item) {
    $discountPrice = $item['price'] - ($item['price'] * $item['discount']) / 100;
    $item_total = $discountPrice * $item['quantity'];
    $discounted_total_price += $item_total;
    $cart_html .= '
    <tr>
        <td><img src="' . $item['image'] . '" class="cart-img" alt="' . $item['name'] . '"></td>
        <td>' . $item['name'] . '</td>
        <td>&#8377;' . $item['price']. '</td>
        <td>&#8377;' . $discountPrice. '</td>
        <td>
            <button class="qty-btn decrease" onclick="updateQuantity(' . $item['id'] . ', \'decrease\')">-</button>
            <span class="quantity" id="qty-' . $item['id'] . '">' . $item['quantity'] . '</span>
            <button class="qty-btn increase" onclick="updateQuantity(' . $item['id'] . ', \'increase\')">+</button>
        </td>
        <td>&#8377;<span id="total-' . $item['id'] . '">' . $item_total . '</span></td>
        <td>
            <button class="remove-btn" onclick="updateQuantity(' . $item['id'] . ', \'remove\')">Remove</button>
        </td>
    </tr>';
}

echo json_encode([
    "cart_html" => $cart_html,
    "discounted_total_price" => $discounted_total_price ?? 0,
]);



