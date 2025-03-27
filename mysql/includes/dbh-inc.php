<?php

$dsn = "mysql:host=localhost;dbname=phpDb";
$dbusername = "kabir@simform";
$dbpassword = "Simform@123";


try{
    $pdo = new PDO($dsn,$dbusername,$dbpassword);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e){
    echo "connectin failed : " . $e->getMessage();
}