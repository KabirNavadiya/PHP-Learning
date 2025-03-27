<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $usersearch = $_POST["usersearch"];

    try {
        //code...
        require_once("includes/dbh-inc.php");
        $query = "SELECT * from comments where username = :usersearch;";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":usersearch",$usersearch );
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die("Query failed : ".$e->getMessage());
    }
}
else{
    header("Location: ../index.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h3>Search Results : </h3>
    <?php

        if(empty($result)){
            echo "No comments found made by user";
        }
        else{
            foreach($result as $r){
                echo "\n".htmlspecialchars($r['username'])."\n".htmlspecialchars($r['comment_text'])."\n". htmlspecialchars($r['created_at']);
            }
            // var_dump($result);
        }
    ?>
</body> 
</html>