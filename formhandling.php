<?php

 if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $favouritepet = htmlspecialchars($_POST["favouritepet"]);

     echo "these are the data, that the user submitted";
     echo "<br>";
     echo $firstname;
     echo "<br>";
     echo $lastname;
     echo "<br>";
     echo $favouritepet;

 }

 ?>