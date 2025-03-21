<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Built-in superGlobal var</title>
</head>
<body>
    <?php
        echo $_SERVER["DOCUMENT_ROOT"];
        echo "<br>";
        echo $_SERVER["PHP_SELF"];
        echo "<br>";
        echo $_SERVER["SERVER_NAME"];
        echo "<br>";
        echo $_SERVER["REQUEST_METHOD"];
        echo "<br>";
        echo $_GET["name"],"\t";  // output : http://localhost:8000/superglobalVariables.php?name=kabir  -> kabir
        echo $_REQUEST["name"];  // output : http://localhost:8000/superglobalVariables.php?name=kabir  -> kabir
        echo "<br>";
        $_SESSION["username"] = "KNavadiya2607";
        echo $_SESSION["username"];



    // all superglobal Variables.
    /*
        $_SERVER[];
        $_GET[];
        $_POST[];
        $_REQUEST[];
        $_FILES[];
        $_COOKIE[];
        $_SESSION[];
        $_ENV[];
    */

    ?> 
</body>
</html>