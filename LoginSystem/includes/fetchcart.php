<?php
session_start();
require_once '../dbh.inc.php';
require_once 'model/addtocart_model.php';

$user_id = $_SESSION['user_id'] ?? null;
$total_price =  0;
$cart_html = "";
if (!$user_id) {
    echo json_encode([
        "cart_html" => $cart_html,
    ]);
    exit;
}

$userCartProducts = getAllUserCartProducts($conn, $user_id);

foreach ($userCartProducts as $item) {
    $discountPrice = $item['price'] - ($item['price'] * $item['discount']) / 100;
    $item_total = $item['price'] * $item['quantity'];
    $subTotal += $item_total;
    $totalDiscount += (($item['price'] * $item['discount']) / 100) * $item['quantity'];
    $total = $subTotal - $totalDiscount;
    $cart_html .= '
    <tr>
        <td><img src="' . 'includes/uploads/' . $item['image'] . '" class="cart-img" alt="' . $item['name'] . '"></td>
        <td>' . $item['name'] . '</td>
        <td>&#8377;' . $discountPrice . '</td>
        <td>
            <button class="qty-btn decrease" onclick="updateQuantity(' . $item['id'] . ', \'decrease\')">-</button>
            <span class="quantity" id="qty-' . $item['id'] . '">' . $item['quantity'] . '</span>
            <button class="qty-btn increase" onclick="updateQuantity(' . $item['id'] . ', \'increase\')">+</button>
        </td>
        <td>&#8377;<span id="total-' . $item['id'] . '">' . $item_total . '</span></td>
        <td>
            <button class="remove-btn" onclick="updateQuantity(' . $item['id'] . ', \'remove\')"><i class="bi bi-trash3"></i></button>
        </td>
    </tr>';

}
$price_summary = '
<h2>Price Summary</h2>
<div class="summary-item">
    <p>Subtotal:</p>
    <span id="subtotal"></span>
</div>
<div class="summary-item">
    <p>Discount:</p>
    <span id="discount"></span>
</div>
<div class="summary-item total">
    <p>Total:</p>
    <span id="total"></span>
</div>

<form action="includes/stripe/stripe_checkout" method="POST">
    <button class="checkout-btn" id="checkout-btn">Proceed to Checkout</button>
</form>';

echo json_encode([
    "cart_html" => $cart_html,
    'hasItems' => !empty($userCartProducts),
    "price_summary" => $price_summary,
    "subtotal" => $subTotal ?? 0,
    "totaldiscount" => $totalDiscount ?? 0,
    "total" => $total ?? 0
]);
