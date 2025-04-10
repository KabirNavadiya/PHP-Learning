<?php

declare(strict_types=1);

function doesExist(object $conn, string $productName)
{
    return getProduct($conn, $productName) ? true : false;
}
