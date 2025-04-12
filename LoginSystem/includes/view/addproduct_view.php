<?php

declare(strict_types=1);
function addProductErrors()
{
    if (isset($_SESSION["errors_addproduct"])) {
        $errors = $_SESSION["errors_addproduct"];
        unset($_SESSION["errors_addproduct"]);
    }
    return $errors;
}
