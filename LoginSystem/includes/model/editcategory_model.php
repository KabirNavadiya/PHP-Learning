<?php

declare(strict_types=1);
function getCurrentCategory(object $conn, int $categoryId)
{
    $query = "SELECT * FROM categories where id = :id;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $categoryId);
    $stmt->execute();
    $result =  $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function updateCategory(object $conn, int $categoryId, string $categoryName)
{
    $query = "UPDATE categories SET name = :categoryname WHERE id = :categoryid;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":categoryid", $categoryId, PDO::PARAM_INT);
    $stmt->bindParam(":categoryname", ucfirst(strtolower($categoryName)));
    $stmt->execute();
}
