<?php

function getUserCartItems($conn, $user_id)
{

    $query = "SELECT p.id as id, p.product_name as name,p.price as price, c.quantity as quantity, p.discount as discount from cart c join products p on c.product_id = p.id where c.user_id = :user_id;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
