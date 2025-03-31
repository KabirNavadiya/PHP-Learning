<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $username = $_POST["username"];
    $pwd = $_POST["password"];

    try {
        //code...
        require_once("dbh-inc.php");
        $query = "DELETE FROM users WHERE username = :username and pwd = :pwd ;";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username",$username );
        $stmt->bindParam(":pwd",$pwd );
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