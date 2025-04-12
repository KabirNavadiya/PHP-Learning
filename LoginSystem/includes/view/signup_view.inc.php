<?php

declare(strict_types=1);
function signupErrors()
{
    if (isset($_SESSION["errors_signup"])) {
        $errors = $_SESSION["errors_signup"];
        unset($_SESSION["errors_signup"]);
    }
    return $errors;
}
