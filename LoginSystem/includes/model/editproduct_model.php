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
function getOldImagePath($conn, $productId)
{
    $query = "SELECT image from products where id = :id;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $productId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function updateProduct(
    object $conn,
    int $productId,
    string $productName,
    string $productCategory,
    string $productPrice,
    string $productDescription,
    ?array $productImage = null
): void {
    $fileName = null;

    if ($productImage && !isFileEmpty($productImage)) {
        $uploadDir = "includes/uploads/";
        $fileName = date("Y-m-d_H-i-s") . '_' . basename($productImage['name']);
        $imagePath = $uploadDir . $fileName;

        if (!move_uploaded_file($productImage['tmp_name'], __DIR__ . "/../../" . $imagePath)) {
            die("Error uploading image.");
        }
    }
    $query = "UPDATE products SET 
                product_name = :productname,
                category_id = :categoryid,
                price = :price,
                description = :description";
    if ($fileName) {
        $query .= ", image = :image";
    }
    $query .= " WHERE id = :id;";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(":productname", strtolower($productName));
    $stmt->bindParam(":categoryid", $productCategory);
    $stmt->bindParam(":price", $productPrice);
    $stmt->bindParam(":description", $productDescription);
    if ($fileName) {
        $stmt->bindParam(":image", $fileName);
    }
    $stmt->bindParam(":id", $productId, PDO::PARAM_INT);
    $stmt->execute();
}
