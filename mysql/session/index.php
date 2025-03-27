<?php

session_start();
$_SESSION["username"] = 'kabir';
session_unset(); // deletes all session data
session_destroy(); // purges data but effect not seen until another page visited.
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    echo $_SESSION["username"];
    ?>
</body>

</html>