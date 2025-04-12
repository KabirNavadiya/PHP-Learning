<?php

function createOrder(object $conn, int $user_id, string $transaction_id, float $totalAmount)
{
    $query = "INSERT INTO orders (user_id, transaction_id, total_amount, status) VALUES (:user_id, :transaction_id, :total_amount, 1);";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":transaction_id", $transaction_id);
    $stmt->bindParam(":total_amount", $totalAmount);
    $stmt->execute();
}
function clearUserCart(object $conn, int $user_id)
{
    $query = "DELETE FROM cart WHERE user_id = :user_id;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
}
function getOrderId(object $conn, string $transaction_id)
{
    $query = "SELECT id as order_id from orders where transaction_id = :transaction_id;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":transaction_id", $transaction_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function setOrderDetails(object $conn, int $orderid, int $product_id, string $product_image, string $product_name, int $product_price, int $quantity)
{
    $query = "INSERT INTO orderdetails (order_id,product_id,product_image,product_name,product_price,quantity) VALUES (:order_id,:product_id,:product_image,:product_name,:product_price,:quantity);";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":order_id", $orderid);
    $stmt->bindParam(":product_id", $product_id);
    $stmt->bindParam(":product_image", $product_image);
    $stmt->bindParam(":product_name", $product_name);
    $stmt->bindParam(":product_price", $product_price);
    $stmt->bindParam(":quantity", $quantity);
    $stmt->execute();
}
function getOrderDetails(object $conn, int $order_id)
{
    $query = "SELECT od.product_image,od.product_name,od.product_price,od.quantity,o.total_amount from orderdetails od join orders o on o.id = od.order_id where od.order_id = :order_id;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":order_id", $order_id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function getUserOrders(object $conn, int $user_id)
{
    $query = "SELECT * FROM orders WHERE user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $orders;
}
function getDetailsAboutOrder(object $conn, int $user_id)
{
    $query = "SELECT p.id as product_id,c.id as cart_id,p.image as product_image, p.product_name as product_name, p.price as product_price, c.quantity as quantity,p.discount as discount from products p join cart c on p.id = c.product_id where user_id = :user_id;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
