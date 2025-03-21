<?php
include 'autoload.php';

// $obj1 = new MyClass(); // Automatically loads MyClass.php
$fruit = new Fruit();
$fruit->set_details("apple",'red');
$details = $fruit->get_details();
echo  $details['color']. " " .$details['name'];
?>
