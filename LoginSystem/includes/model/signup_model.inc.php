<?php

declare(strict_types=1);


function getUsername(object $conn, string $username)
{
    $query = "SELECT username FROM users where username = :username or email = :username;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $result =  $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: null;
}
function getUserEmail(object $conn, string $email)
{
    $query = "SELECT email FROM users where email = :email;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $result =  $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: null;
}

function setUser(object $conn, string $email, string $username, string $password, string $contact, string $dob)
{
    $query = "INSERT INTO users (username,pwd,email,contact,date_of_birth) values (:username,:pwd,:email,:contact,:dob)";
    $stmt = $conn->prepare($query);

    $options = ['cost' => 12];

    $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":contact", $contact);
    $stmt->bindParam(":dob", $dob);
    $stmt->execute();
}
