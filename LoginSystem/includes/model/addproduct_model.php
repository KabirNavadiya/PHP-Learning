<?php

// declare(strict_types=1);

function getProduct(object $conn, string $productName)
{
    $query = "SELECT product_name FROM products where product_name = :productname;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":productname", $productName);
    $stmt->execute();
    $result =  $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: null;
}
function setProduct(object $conn, string $productName, string $productCategory, string $productPrice, string $productDescription, array $productImage, int $discount)
{

    $uploadDir = "includes/uploads/";
    $fileName = date("Y-m-d_H-i-s") . '_' . basename($productImage['name']);
    $imagePath = $uploadDir . $fileName;

    if (!move_uploaded_file($productImage['tmp_name'], __DIR__ . "/../../" . $imagePath)) {
        die("Error uploading image.");
    }
    $query = "INSERT INTO products (product_name,category_id,price,description,image,discount) values (:productname,:categoryid,:price,:description,:image,:discount);";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":productname", strtolower($productName));
    $stmt->bindParam(":categoryid", $productCategory);
    $stmt->bindParam(":price", $productPrice);
    $stmt->bindParam(":description", $productDescription);
    $stmt->bindParam(":image", $fileName);
    $stmt->bindParam(":discount", $discount);
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

function getProducts(object $conn)
{
    $query = "SELECT p.id AS id,p.product_name AS product_name,c.name AS category_name,p.price AS price,p.description AS description,p.image AS image,discount as discount FROM products p JOIN categories c ON p.category_id = c.id;";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $products = $stmt->fetchAll();
    return $products;
}
