<?php


$host = 'localhost';
$dbname = 'phpDb';
$dbusername = 'kabir@simform';
$dbpassword = 'Simform@123';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Connection failed : " . $e->getMessage());
}
