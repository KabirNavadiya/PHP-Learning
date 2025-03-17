<?php
// INDEXED ARRAY
// access element in indexed array
$cars = array("Volvo", "BMW", "Toyota");
echo $cars[0],"\n";
echo $cars[1],"\n";
echo $cars[2],"\n";

// modify array

$cars[1]= "Lamborghini";
print_r($cars);


// loop through indexed array 
foreach ($cars as $i) {
    echo $i,"\n";
}

// add element from last
$cars = array("Volvo", "BMW", "Toyota");
array_push($cars,"konigseg");
print_r($cars);


// ASSOCIATIVE ARRAY

$car = array("brand"=>"Ford", "model"=>"Mustang", "year"=>1964);
echo $car["model"];

// modify associative array.
$car['year'] = 2001;
print_r($car);

//loop through array.
$car = array("brand"=>"Ford", "model"=>"Mustang", "year"=>1964);
foreach ($car as $x => $y) {
    echo "$x : $y\n";
}

// add element to array
$car = array("brand"=>"Ford", "model"=>"Mustang", "year"=>1964);
$car['rank'] = 1;
print_r($car);


//create array
$array1 = array(1,2,3,4,5);
$array2 = [6,7,8,9,10];
print_r($array1);
print_r($array2);

// empty array.
$car = [];
array_push($car,'Ford GT');
array_push($car,'Mercedes Benz');
array_push($car,'Lamborghini Gallardo');
print_r($car);


// execute a function item
function myFunction() {
    echo "I come from a function!";
}
  
$myArr = array("Volvo", 15, myFunction());
$myArr[2];



// add multiple elements to array
$cars = array("brand" => "Ford", "model" => "Mustang");
print_r($cars);
$cars += ["color" => "red", "year" => 1964];
print_r($cars);

$num1 = [1,2];
$num2 = [3,4,5];
print_r(array_merge($num1,$num2));



// sort array
$numbers = array(4, 6, 2, 22, 11);
sort($numbers);
print_r($numbers);



// multi dimentional array
$cars = array (
    array("Volvo",22,18),
    array("BMW",15,13),
    array("Saab",5,2),
    array("Land Rover",17,15)
);


echo $cars[0][0].": In stock: ".$cars[0][1].", sold: ".$cars[0][2]."\n";
echo $cars[1][0].": In stock: ".$cars[1][1].", sold: ".$cars[1][2]."\n";
echo $cars[2][0].": In stock: ".$cars[2][1].", sold: ".$cars[2][2]."\n";
echo $cars[3][0].": In stock: ".$cars[3][1].", sold: ".$cars[3][2]."\n";



// BASIC ARRAY FUNCTION.
?>