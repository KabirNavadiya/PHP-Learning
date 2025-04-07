<?php

declare(strict_types=1);
function getUser(object $conn, string $email)
{
    $query = "SELECT * FROM users where  email = :email ;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $result =  $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function setPass(object $conn, string $email, string $h_pwd)
{
    $query = "UPDATE users SET pwd = :newpass where email = :email ;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":newpass", $h_pwd);
    $stmt->execute();
}
