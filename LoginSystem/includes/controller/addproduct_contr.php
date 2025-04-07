<?php

declare(strict_types=1);

function isInputEmpty(
    string $productName,
    string $productCategory,
    string $productPrice,
    string $productDescription,
    array $productImage
) {
    return (empty($productName) || empty($productCategory) || empty($productPrice) || empty($productDescription) || !isset($productImage['error']) || $productImage['error'] === UPLOAD_ERR_NO_FILE) ? true : false;
}

function doesExist(object $conn, string $productName)
{
    return getProduct($conn, $productName) ? true : false;
}
