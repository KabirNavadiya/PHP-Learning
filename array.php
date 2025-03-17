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

// array_chunk
$cars=array("Volvo","BMW","Toyota","Honda","Mercedes","Opel");
print_r(array_chunk($cars,4));


// frequency count.
$cars = [1,1,2,2,1,3,4,6];
print_r(array_count_values($cars));


// array_fill

$arr1 = [1,2,3];
$arr1 += array_fill(3,5,0);
print_r($arr1);



//filter

function test_odd($var)
  {
  return($var & 1);
  }

$a1=array(1,3,2,3,4);
print_r(array_filter($a1,"test_odd"));


// array_map

function myfunction($v)
{
  return($v*$v);
}

$a=array(1,2,3,4,5);
print_r(array_map("myfunction",$a));


// merge array

$num1 = [1,2];
$num2 = [3,4,5];
print_r(array_merge($num1,$num2));


// remove last element from array using pop.
$numbers = [1,2,3,4];
array_pop($numbers);
print_r($numbers);


// Send the values in an array to a user-defined function and return a string:
function myfunction($v1,$v2)
{
return $v1 . "-" . $v2;
}
$a=array("Dog","Cat","Horse");
print_r(array_reduce($a,"myfunction"));

// search for a value in array.

$a=array("a"=>"red","b"=>"green","c"=>"blue");
$b = [1,2,3,6];
echo array_search(2,$b);
echo array_search("red",$a);


// remove first element from array
$a=array("a"=>"red","b"=>"green","c"=>"blue");
echo array_shift($a);
print_r ($a);


// slice
$a=array("red","green","blue","yellow","brown");
print_r(array_slice($a,2,1));

// splice - removes or replaces specified elements
$a1=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
$a2=array("a"=>"purple","b"=>"orange");
array_splice($a1,0,2,$a2);
print_r($a1);



// remove duplicate
$nums = [1,1,2,2,1,3,4,6];
print_r(array_unique($nums));

// sum of array.
$nums = [1,1,2,2,1,3,4,6];
echo array_sum($nums);

// add element at start of array
$nums = [1,1,2,2,1,3,4,6];
array_unshift($nums,0);
print_r($nums);

// length of array
$nums = [1,1,2,2,1,3,4,6];
echo count($nums);

?>