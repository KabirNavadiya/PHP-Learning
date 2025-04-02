<?php

declare(strict_types=1);
function isFileEmpty(array $productImage) {
    if (!isset($productImage['error']) || $productImage['error'] === UPLOAD_ERR_NO_FILE) {
        return true;
    }
    return false;
}