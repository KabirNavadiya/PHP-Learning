<?php

declare(strict_types=1);

function getCurrentProduct(object $conn, int $productId)
{
    $query = "SELECT * FROM products where id = :id;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $productId);
    $stmt->execute();
    $result =  $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function updateWithImage(object $conn, int $productid, string $productName, string $productCategory, string $productPrice, string $productDescription, array $productImage)
{
    $uploadDir = "includes/uploads/";
    $fileName = time() . "_" . basename($productImage['name']);
    $imagePath = $uploadDir . $fileName;

    if (!move_uploaded_file($productImage['tmp_name'], __DIR__ . "/../../" . $imagePath)) {
        die("Error uploading image.");
    }

    $query = "UPDATE products SET product_name = :productname,category_id = :categoryid, price = :price, description = :description, image = :image WHERE id = :id;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":productname", strtolower($productName));
    $stmt->bindParam(":categoryid", $productCategory);
    $stmt->bindParam(":price", $productPrice);
    $stmt->bindParam(":description", $productDescription);
    $stmt->bindParam(":image", $imagePath);
    $stmt->bindParam(":id", $productid);
    $stmt->execute();

}

function updateWithoutImage(object $conn,int $productid, string $productName, string $productCategory, string $productPrice, string $productDescription)
{
    
    $query = "UPDATE products SET product_name = :productname,category_id = :categoryid, price = :price, description = :description WHERE id = :id;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $productid, PDO::PARAM_INT);
    $stmt->bindParam(":productname", strtolower($productName));
    $stmt->bindParam(":categoryid", $productCategory);
    $stmt->bindParam(":price", $productPrice);
    $stmt->bindParam(":description", $productDescription);
    
    $stmt->execute();
    
}
