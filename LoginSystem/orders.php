<?php
require_once 'dbh.inc.php';
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
    <noscript>Please Enable Javascript !</noscript>
    <a href="/index" class="btn btn-primary">
        ← Back
    </a>
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
    <script src="js/orders.js"></script>
</body>

</html>