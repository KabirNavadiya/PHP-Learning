<?php

declare(strict_types=1);
function isProductExist(object $conn, int  $user_id, int $product_id)
{

    if (getUserCartProducts($conn, $user_id, $product_id)) {
        return true;
    } else {
        return false;
    }
}
