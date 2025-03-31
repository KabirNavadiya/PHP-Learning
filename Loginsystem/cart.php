<?php

require_once 'includes/dbh.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/model/addtocart_model.php';

if(isset($_SESSION['user_id'])){
    $userCartProducts = getAllUserCartProducts($conn, $_SESSION['user_id']);
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/cart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
        .qty-btn {
            width: 30px;
            height: 30px;
            border: none;
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.61);
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .qty-btn:hover {
            background-color: rgb(0, 0, 0);
        }

        .quantity {
            font-size: 16px;
            padding: 0 10px;
            display: inline-block;
            min-width: 30px;
            text-align: center;
        }

        .cart-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>


</head>

<body>
    <a href="index.php" class="btn btn-primary">
        ← Back
    </a>
    <div class="cart-container">
        <h1>Shopping Cart</h1>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="cart-table-body">

            </tbody>
        </table>

        <div class="cart-footer">
            <h2></h2>
            <button class="checkout-btn">Proceed to Checkout</button>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

   
        function updateQuantity(cartProductId, action) {

            $.ajax({
                url: "includes/updatecart.php",
                type: "POST",
                data: {
                    cartProductId: cartProductId,
                    action: action
                },
                dataType: "json",

                success: function(response) {
                    if (response.success) {
                        fetchCart();
                    } else {
                        alert("❌ Error: " + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                }
            });
        }

        function fetchCart() {
            $.ajax({
                url: "includes/fetchcart.php", // Fetch cart data
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        // $("#cart-table-body").html("<tr><td colspan='6'>" + response.error + "</td></tr>");
                        // $(".cart-footer h2").html("Total: ₹0");
                        
                    } else {
                        $("#cart-table-body").html(response.cart_html);
                        $(".cart-footer h2").html("Total: ₹" + response.total_price);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                }
            });
        }
        $(document).ready(function() {
            fetchCart();

        });
    </script>

</body>

</html>