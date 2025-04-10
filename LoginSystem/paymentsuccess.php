<?php

require_once 'dbh.inc.php';
require_once 'includes/model/order_model.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/model/addtocart_model.php';
require_once 'includes/user_redirect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$secret_key = $_ENV['STRIPE_SECRET_KEY'];
$mail_pwd = $_ENV['MAIL_PWD'];


if (!isset($_GET['session_id'])) {
    header("Location: /cart");
    exit;
}
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

function getUserEmail($conn, $userid)
{
    $query = "SELECT email from users where id=:id;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

\Stripe\Stripe::setApiKey($secret_key);
try {
    $session = \Stripe\Checkout\Session::retrieve($_GET['session_id']);

    $userid = $_SESSION['user_id'];
    $useremail = getUserEmail($conn, $userid);
    if ($session->payment_status === "paid") {

        $transaction_id = $session->payment_intent;
        $total_amount = $session->amount_total / 100;
        $user_id = $_SESSION['user_id'];
        createOrder($conn, $user_id, $transaction_id, $total_amount);
        $orderid = getOrderId($conn, $transaction_id);
        $details = getDetailsAboutOrder($conn, $user_id);
        foreach ($details as $detail) {
            setOrderDetails($conn, $orderid['order_id'], $detail['product_id'], $detail['product_image'], $detail['product_name'], $detail['product_price'], $detail['quantity']);
        }

        $product_details = [];
        foreach ($details as $detail) {
            array_push($product_details, [
                "product_name" => $detail['product_name'],
                "original_price" => $detail['product_price'],
                "product_discount" => $detail['discount'],
                "discount_price" => $detail['product_price'] - ($detail['product_price'] * $detail['discount']) / 100,
                "product_quantity" => $detail['quantity']
            ]);
        }

        $totalAmount = 0;
        $date = date("d M Y");
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL']; // Your Gmail address
            $mail->Password = $mail_pwd; // Generate an App Password for Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($_ENV['EMAIL'], 'Kabir');
            $mail->addAddress($useremail['email']);

            $mail->isHTML(true); // Ensure email is sent as HTML
            $mail->Subject = "#Order Summary";

            // Initialize message string properly
            $message = "<html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Payment Receipt</title>
                <style>
                    body {
                        font-family: 'Arial', sans-serif;
                        margin: 0;
                        padding: 20px;
                        background-color: #f4f4f4;
                    }
                    .receipt-container {
                        max-width: 600px;
                        background: white;
                        padding: 25px;
                        border-radius: 10px;
                        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                        margin: auto;
                    }
                    .receipt-header {
                        text-align: center;
                        margin-bottom: 20px;
                        color: #333;
                    }
                    .receipt-header h2 {
                        margin: 0;
                        font-size: 22px;
                        color: #007bff;
                    }
                    .receipt-header p {
                        margin: 5px 0;
                        font-size: 14px;
                        color: #555;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 20px;
                        background: #fff;
                        border-radius: 5px;
                        overflow: hidden;
                    }
                    th, td {
                        padding: 12px;
                        border-bottom: 1px solid #ddd;
                        text-align: left;
                        font-size: 14px;
                    }
                    th {
                        background: #007bff;
                        color: white;
                        text-transform: uppercase;
                        font-size: 13px;
                    }
                    tbody tr:nth-child(even) {
                        background: #f8f8f8;
                    }
                    .total {
                        font-size: 16px;
                        font-weight: bold;
                        text-align: right;
                        color: #333;
                    }
                    .total strong {
                        color: #28a745;
                    }
                </style>
            </head>
            <body>
                <div class='receipt-container'>
                    <div class='receipt-header'>
                        <h2>Payment Receipt</h2>
                        <p>Date: " . date("d M Y") . "</p>
                        <p>Transaction ID : " . $transaction_id . "</p>
                    </div>
        
                    <table>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Original Price</th>
                                <th>Discount</th>
                                <th>Discounted Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>";

            foreach ($product_details as $product) {
                $message .= "<tr>
                        <td>" . htmlspecialchars($product["product_name"]) . "</td>
                        <td>&#8377;" . number_format($product["original_price"], 2) . "</td>
                        <td>" . $product["product_discount"] . "%</td>
                        <td>&#8377;" . number_format($product["discount_price"], 2) . "</td>
                        <td>" . $product["product_quantity"] . "</td>
                        <td>&#8377;" . $product["discount_price"] * $product['product_quantity'] . "</td>
                    </tr>";
            }

            $message .= "</tbody>
                    </table>
        
                    <p class='total'>Total Amount: <strong>&#8377;" . number_format($total_amount, 2) . "</strong></p>
                </div>
            </body>
            </html>";

            $mail->Body = $message;

            $mail->send();
        } catch (Exception $e) {
            echo "Mail could not be sent. Error: {$mail->ErrorInfo}";
        }

        clearUserCart($conn, $user_id);

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            showLoader("Payment successful! Redirecting...");
                setTimeout(function() {
                    window.location.href = "/";
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
        header("Location: /cart");
    }
} catch (Exception $e) {
    header("Location: /cart?error=" . urlencode($e->getMessage()));
}
