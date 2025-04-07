<?php

declare(strict_types=1);
function isFileEmpty(array $productImage)
{
    return !isset($productImage['error']) || $productImage['error'] === UPLOAD_ERR_NO_FILE ? true : false;
}
