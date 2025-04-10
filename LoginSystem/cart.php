<?php

require_once 'dbh.inc.php';
require_once 'includes/config_session.inc.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <noscript>Please Enable Javascript !</noscript>

    <a href="/" class="btn btn-primary">← Back</a>

    <div class="cart-wrapper">
        <div class="cart-container">
            <h1>Shopping Cart</h1>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Item Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="cart-table-body">
                </tbody>
            </table>
            <div id="add-items">
                <h1>Your Cart Is Empty !</h1>
                <button class="btn btn-primary" onclick="window.location.href='/'">Add items</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/cart.js"></script>
</body>


</html>