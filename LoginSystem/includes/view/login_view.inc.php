<?php

declare(strict_types=1);
function loginErrors()
{
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];
        unset($_SESSION["errors_login"]);
    }
    return $errors;
}
function getUsername()
{
    if (isset($_SESSION["user_id"])) {
        echo $_SESSION["user_username"];
    } else {
        echo "Login";
    }
}
