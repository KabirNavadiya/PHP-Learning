<?php

declare(strict_types=1);
function isProductExist(object $conn, int  $user_id, int $product_id)
{
    return getUserCartProducts($conn, $user_id, $product_id) ? true : false;
}
