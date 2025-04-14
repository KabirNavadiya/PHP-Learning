<?php

declare(strict_types=1);
function deleteCategory(object $conn, int $categoryId)
{
    $query = "DELETE from categories WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $categoryId, PDO::PARAM_INT);
    $stmt->execute();
}
