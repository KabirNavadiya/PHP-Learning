<?php
// returns absolute positive value.

echo abs(6.7) ,"\n";
echo abs(-6.7) , "\n";
echo abs(-3) ,"\n";
echo abs(3);


// base convert 

$hex = "E196";
echo base_convert($hex,16,2);

// bin to dec
echo bindec("0011");

// dec to bin
echo decbin("3");


// round up to nearest integer.
echo ceil(0.60), "\t";
echo ceil(0.50);


// round below to nearesst integer.
echo floor(0.60);


// maximum possible value from rand()
echo getrandmax();


// round floating point number 
echo round(0.49);


// define constant 
define("GREETING", "Welcome to W3Schools.com!");
echo GREETING;


// OPERATORS

// PHP Arithmetic Operators
$x = 10;  
$y = 6;

echo $x + $y,"\n";
echo $x - $y,"\n";
echo $x * $y,"\n";
echo $x / $y,"\n";
echo $x % $y,"\n";
echo $x ** $y,"\n";


//PHP Assignment Operators

$x = 20;  
$x += 100;
$x -=100;
$x *= 10;
$x /= 2;
$x %= 2;

echo $x;

// PHP Comparison Operators

$x = 1;  
$y = 10;
// spaceship operator.
echo ($x <=> $y);



// PHP Array Operators

$x = array("a" => "red", "b" => "green");  
$y = array("c" => "blue", "d" => "yellow");  

print_r($x + $y); // union of $x and $y
var_dump($x == $y); // Returns true if $x and $y have the same key/value pairs	
var_dump($x === $y);
var_dump($x !== $y); // Returns true if $x is not identical to $y
?>