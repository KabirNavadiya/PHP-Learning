<?php


declare(strict_types=1);
function editProductErrors()
{
    if (isset($_SESSION["errors_editproduct"])) {
        $errors = $_SESSION["errors_editproduct"];
        unset($_SESSION["errors_editproduct"]);
    }
    return $errors;
}
