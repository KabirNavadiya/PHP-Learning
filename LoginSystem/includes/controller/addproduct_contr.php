<?php

declare(strict_types=1);

function isInputEmpty(
    string $productName,
    string $productCategory,
    string $productPrice,
    string $productDescription,
    array $productImage 
) {
    if (empty($productName) || empty($productCategory) || empty($productPrice) || empty($productDescription)) {
        return true;
    }

    if (!isset($productImage['error']) || $productImage['error'] === UPLOAD_ERR_NO_FILE) {
        return true;
    }

    return false;
}



function doesExist(object $conn,string $productName){
    if(getProduct($conn,$productName)){
        return true;
    }
    else{
        return false;
    }
}

