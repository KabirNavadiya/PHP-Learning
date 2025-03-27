<?php

declare(strict_types=1);


function getProduct(object $conn, string $productName)
{
    $query = "SELECT product_name FROM products where product_name = :productname;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":productname", $productName);
    $stmt->execute();
    $result =  $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: null;
}
function setProduct(object $conn, string $productName, string $productCategory, string $productPrice, string $productDescription, array $productImage)
{

    $uploadDir = "includes/uploads/";
    $fileName = basename($productImage['name']);
    $imagePath = $uploadDir . $fileName;


    if (!move_uploaded_file($productImage['tmp_name'], __DIR__ . "/../../" . $imagePath)) {
        die("Error uploading image.");
    }

    $query = "INSERT INTO products (product_name,category_id,price,description,image) values (:productname,:categoryid,:price,:description,:image);";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":productname", strtolower($productName));
    $stmt->bindParam(":categoryid", $productCategory);
    $stmt->bindParam(":price", $productPrice);
    $stmt->bindParam(":description", $productDescription);
    $stmt->bindParam(":image", $imagePath);
    $stmt->execute();
}


function getCategories(object $conn)
{
    $query = "SELECT * FROM categories";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    return $categories;
}

function getProducts($conn)
{
    $query = "SELECT p.id AS id,p.product_name AS product_name,c.name AS category_name,p.price AS price,p.description AS description,p.image AS image FROM products p JOIN categories c ON p.category_id = c.id;";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $products = $stmt->fetchAll();
    return $products;
}
