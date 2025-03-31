<?php

declare(strict_types=1);


function getUserCartProducts(object $conn, int $user_id,int $product_id)
{
    $query = "SELECT * FROM cart WHERE user_id = :userid and product_id = :productid ;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":userid", $user_id);
    $stmt->bindParam(":productid", $product_id);
    $stmt->execute();
    $cart_items = $stmt->fetchAll();
    return $cart_items;
}

function setProductToCart(object $conn,int $user_id, int $product_id){
    $query = "INSERT INTO cart (user_id, product_id) VALUES (:user_id, :product_id);";
    $stmt = $conn -> prepare($query);
    $stmt ->bindParam(":user_id",$user_id);
    $stmt ->bindParam(":product_id",$product_id);
    $stmt->execute();
}

function updateProductQuantity(object $conn,int $user_id,int $product_id){
    $query = "UPDATE cart SET quantity = quantity + 1 where user_id = :userid and product_id = :productid ; ";
    $stmt = $conn -> prepare($query);
    $stmt -> bindParam(":userid",$user_id);
    $stmt -> bindParam(":productid",$product_id);
    $stmt -> execute();
}

function getAllUserCartProducts(object $conn,int $user_id){
    $query = "SELECT c.id as id,p.image as image, p.product_name as name, p.price as price, c.quantity as quantity from products p join cart c on p.id = c.product_id; ";
    $stmt = $conn -> prepare($query);
    $stmt -> execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}