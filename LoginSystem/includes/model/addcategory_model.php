<?php

declare(strict_types=1);
function getCategory(object $conn, string $categoryName)
{
    $query = "SELECT name FROM categories where name = :categoryname;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":categoryname", $categoryName);
    $stmt->execute();
    $result =  $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: null;
}
function setCategory(object $conn, string $categoryName)
{
    $query = "INSERT INTO categories (name) values (:categoryname);";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":categoryname", ucfirst(strtolower($categoryName)));
    $stmt->execute();
}
function getAllCategories(object $conn)
{
    $query = "SELECT * FROM categories";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    return $categories;
}
