<?php

declare(strict_types=1);
function isUsernameWrong(bool|array $results)
{
    if (!$results) {
        return true;
    } else {
        return false;
    }
}

function isPasswordWrong(string $pwd, string $hashedpwd)
{
    if (!password_verify($pwd, $hashedpwd)) {
        return true;
    } else {
        return false;
    }
}
function isEmpty(string $username, string $pwd)
{
    if (empty($username) || empty($pwd)) {
        return true;
    } else {
        return false;
    }
}

function isAdmin(string $role)
{
    if ($role === "admin") {
        return true;
    } else {
        return false;
    }
}
