<?php

declare(strict_types=1);

function isInputEmpty(string $categoryName): bool
{
    return empty($categoryName);
}

function doesExist(object $conn, string $categoryName)
{
    if (getCategory($conn, $categoryName)) {
        return true;
    } else {
        return false;
    }
}
