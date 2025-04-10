<?php

declare(strict_types=1);

function increaseUserProductQuantity(object $conn, int $cartProductId, int $user_id)
{
    $query = "UPDATE cart SET quantity = quantity + 1 where user_id = :userid and id = :cartProductId ; ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":userid", $user_id);
    $stmt->bindParam(":cartProductId", $cartProductId);
    $stmt->execute();
}
function decreaseUserProductQuantity(object $conn, int $cartProductId, int $user_id)
{
    $query = "UPDATE cart SET quantity = quantity - 1 where user_id = :userid and id = :cartProductId ; ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":userid", $user_id);
    $stmt->bindParam(":cartProductId", $cartProductId);
    $stmt->execute();
}
function getProductQuantity(object $conn, int $cartProductId,)
{
    $query = "SELECT quantity from cart where id = :cartproductid";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":cartproductid", $cartProductId);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function deletFromCart(object $conn, int $cartProductId)
{
    $query = "DELETE FROM cart where id = :cartproductid";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":cartproductid", $cartProductId, PDO::PARAM_INT);
    $stmt->execute();
}
