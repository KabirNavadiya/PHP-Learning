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

function isDifferent(string $n_pwd, string $c_pwd)
{
    if ($n_pwd !== $c_pwd) {
        return true;
    } else {
        return false;
    }
}
function isEmpty(string $username, string $n_pwd,string $c_pwd)
{
    if (empty($username) || empty($n_pwd) || empty($c_pwd)) {
        return true;
    } else {
        return false;
    }
}


