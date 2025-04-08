<?php

declare(strict_types=1);
function addCategoryErrors()
{
    if (isset($_SESSION["errors_addcategory"])) {
        $errors = $_SESSION["errors_addcategory"];
        unset($_SESSION["errors_addcategory"]);
    }
    return $errors;
}
