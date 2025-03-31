<?php

declare(strict_types=1);
function getUser(object $conn, string $username)
{
    $query = "SELECT * FROM users where username = :username or email = :username ;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $result =  $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function setPass(object $conn, string $username, string $h_pwd)
{
    $query = "UPDATE users SET pwd = :newpass where username = :username ;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":newpass", $h_pwd);
    $stmt->execute();
}
