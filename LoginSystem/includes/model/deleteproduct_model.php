<?php

declare(strict_types=1);
function deleteProduct(object $conn, int $productid)
{
    $query = "DELETE from products WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $productid, PDO::PARAM_INT);
    $stmt->execute();
}
