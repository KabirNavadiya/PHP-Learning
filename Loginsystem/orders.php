<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/model/order_model.php';
session_start();
$user_id = $_SESSION['user_id'];
$orders = getUserOrders($conn, $user_id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/orders.css">

</head>

<body>
    <div class="container">
        <h1>My Orders</h1>
        <div class="orders">
            <?php
            if ($orders) {
                foreach ($orders as $order) {
                    echo "<div class='order-card'>";
                    echo "<p><strong>Order ID:</strong> " . $order['id'] . "</p>";
                    echo "<p><strong>Transaction ID:</strong> " . $order['transaction_id'] . "</p>";
                    echo "<p><strong>Total Amount:</strong> &#8377;" . $order['total_amount'] . "</p>";
                    echo "<p><strong>Status:</strong> " . $order['status'] . "</p>";
                    echo '<div id="order-details-container-' . $order['id'] . '" style="display:none">
                            
                        </div>';
                    echo '<button class="view-btn" data-order-id="' . $order['id'] . '">View Details</button>';
                    echo "</div>";
                }
            } else {
                echo "<p>No orders found.</p>";
            }
            ?>

        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on("click", ".view-btn", function() {
            var orderId = $(this).data("order-id");
            $.ajax({
                url: "includes/order_details.php",
                type: "POST",
                data: {
                    orderId: orderId
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        displayOrderDetails(response.order_details, orderId);
                    } else {
                        alert("❌ Error: " + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                }
            });
        });


        function displayOrderDetails(orderDetails, orderId) {
            var containerId = "#order-details-container-" + orderId;

            $(containerId).html('');
            var header = "<h2 id='order-details'>Order Details</h2>";
            $(containerId).append(header);
            orderDetails.forEach(product => {
                var productHtml = `
                
                <div class="order-item">
                <div class="order-info">
                    <p class="product-name"><strong>Product Name:</strong> ${product.product_name}</p>
                    <div class="product-image-container">
                        <img src="${product.product_image}" alt="${product.product_name}" class="product-image">
                    </div>
                    <p><strong>Quantity:</strong> ${product.quantity}</p>
                    <p><strong>Price:</strong> ₹${product.product_price}</p>
                </div>
                <p class="total-price"><strong>Total:</strong> ₹${product.total_amount}</p>
            </div>
        `;      
                $(containerId).append(productHtml);
            });

            $(containerId).slideToggle('slow');
        }
    </script>
</body>

</html>