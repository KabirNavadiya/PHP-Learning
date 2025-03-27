<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $username = $_POST["username"];
    $pwd = $_POST["password"];
    $email = $_POST["email"];

    try {
        //code...
        require_once("dbh-inc.php");
        $query = "UPDATE users SET username = :username, pwd = :pwd, email = :email where id = 4;";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username",$username );
        $stmt->bindParam(":pwd",$pwd );
        $stmt->bindParam(":email",$email );
        $stmt->execute();
        // $stmt->execute([$username,$password,$email]);

        $pdo = null;
        $stmt = null;
        header("Location: ../index.php");
        die();

    } catch (PDOException $e) {
        die("Query failed : ".$e->getMessage());
    }
}
else{
    header("Location: ../index.php");
}