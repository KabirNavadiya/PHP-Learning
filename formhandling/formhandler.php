<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // sanitizing the data using htmlspecialchars.
    // cannot inject code inside the form.
    // treats '&' as  html->'$amp'.

    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $favouritepet = htmlspecialchars($_POST["favouritepet"]);

    if(empty($firstname) || empty($lastname) || empty($favouritepet)) {
        header("Location: ../index.php");
        exit(); 
    }

    echo "these are the data that user submitted";
    echo "<br>";
    echo $firstname;
    echo "<br>";
    echo $lastname;
    echo "<br>";
    echo $favouritepet;
    echo "<br>";


    header("Location: ../index.php");
}else{
    header("Location: ../index.php");
}
