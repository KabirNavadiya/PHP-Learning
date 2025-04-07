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
function isEmpty(string $username, string $pwd)
{
    return (empty($username) || empty($pwd));
}

function isAdmin(string $role)
{
    return $role === "admin" ? true : false;
}
