<?php

declare(strict_types=1);
function isEmailInvalid(string $email)
{
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}
function isUserNameTaken(object $conn, string $username)
{
    return getUsername($conn, $username);
}
function isEmailRegistered(object $conn, string $email)
{
    return getUserEmail($conn, $email);
}
function createUser(object $conn, string $email, string $username, string $password, string $contact, string $dob)
{
    setUser($conn, $email, $username, $password, $contact, $dob);
}
function validatePassword(string $pwd)
{
    $regex = '/(?=.*[a-z])+(?=.*[A-Z])+(?=.*\d)+(?=.*[@#\$%^&*()+=\[\]{};:\'\"\\|,.<>\/?])+/';
    if (strlen($pwd) < 8) {
        return "Password must be of atleast of 8 chars";
    } else if (!preg_match($regex, $pwd)) {
        return '
                <ul style= "color:red">
                <p>Password Must : </p>
                <li>must contain atleast 1 lowercase</li>
                <li>must contain atleast 1 uppercase</li>
                <li>must contain atleast 1 digit</li>
                <li>must contain atleast 1 special character</li>
                </ul>';
    }
}
function validateContact(string $contact)
{
    $regex = '/^[6-9]\d{9}$/';
    if (strlen($contact) < 10) {
        return "Enter valid contact";
    } else if (!preg_match($regex, $contact)) {
        return "Enter Valid Contact number!(must start with 6,7,8 or 9)";
    }
}
