<?php

declare(strict_types=1);
function isUsernameWrong(bool|array $results)
{
    return !$results;
}

function isDifferent(string $n_pwd, string $c_pwd)
{
    return $n_pwd !== $c_pwd ? true : false;
}
function isEmpty(string $email, string $n_pwd, string $c_pwd)
{
    return (empty($email) || empty($n_pwd) || empty($c_pwd));
}

function validatePassword($pwd)
{

    $regex = '/(?=.*[a-z])+(?=.*[A-Z])+(?=.*\d)+(?=.*[@#\$%^&*()+=\[\]{};:\'\"\\|,.<>\/?])+/';
    if (strlen($pwd) < 8) {
        return "Password must be of atleast of 8 chars";
    } else if (!preg_match($regex, $pwd)) {
        return '
                <ul>
                <p>Password Must : </p>
                <li> contain atleast 1 lowercase</li>
                <li> contain atleast 1 uppercase</li>
                <li> contain atleast 1 digit</li>
                <li> contain atleast 1 special character</li>
                </ul>';
    }
}
