<?php

declare(strict_types=1);

function isInputEmpty(string $categoryName) {
    if (empty($categoryName)) {
        return true;
    }
    return false;
}



function doesExist(object $conn,string $categoryName){
    if(getCategory($conn,$categoryName)){
        return true;
    }
    else{
        return false;
    }
}

