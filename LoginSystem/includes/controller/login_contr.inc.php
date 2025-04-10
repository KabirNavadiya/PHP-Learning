<?php

declare(strict_types=1);
function isUsernameWrong(bool|array $results)
{
    return !$results;
}

function isPasswordWrong(string $pwd, string $hashedpwd)
{
    return (!password_verify($pwd, $hashedpwd));
}

function isAdmin(string $role)
{
    return $role === "admin" ? true : false;
}
