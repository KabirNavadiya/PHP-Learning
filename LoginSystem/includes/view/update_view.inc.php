<?php

declare(strict_types=1);
function updateErrors()
{
    if (isset($_SESSION["errors_update"])) {
        $errors = $_SESSION["errors_update"];
        unset($_SESSION["errors_update"]);
    }
    return $errors;
}
