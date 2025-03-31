<?php

if (5 > 3) {
    echo "5 is greater than 3 !";
}


$t = 14;

if ($t < 20) {
  echo "variable is grater then 20";
}


$t = date("H");

if ($t < "20") {
  echo "Have a good day!";
} else {
  echo "Have a good night!";
}


$a = 13;
$b = $a < 10 ? "Hello" : "Good Bye";
echo $b;


$a = 13;

if ($a > 10) {
  echo "Above 10";
  if ($a > 20) {
    echo " and also above 20";
  } else {
    echo " but not above 20";
  }
}


$favcolor = "blue";

switch ($favcolor) {
  case "red":
    echo "Your favorite color is red!";
    break;
  case "blue":
    echo "Your favorite color is blue!";
    break;
  case "green":
    echo "Your favorite color is green!";
    break;
  default:
    echo "Your favorite color is neither red, blue, nor green!";
}

$food = 'bar';
$return_value = match ($food) {
    'apple' => 'This food is an apple',
    'bar' => 'This food is a bar',
    'cake' => 'This food is a cake',
};

var_dump($return_value);


$age = 18;
$output = match (true) {
    $age < 2 => "Baby",
    $age < 13 => "Child",
    $age <= 19 => "Teenager",
    $age <= 40 => "Old adult",
    $age > 19 => "Young adult",
};
var_dump($output); // here age<=19 is matched and value is returned so age<=40 will not be checked.




$value = "10";
$result = match ($value) {
    10 => "Integer 10",
    "10" => "String 10",
    default => "No match"
};
echo $result;


$text = 'Bienvenue chez nous';

$result = match (true) {
    str_contains($text, 'Welcome') || str_contains($text, 'Hello') => 'en',
    str_contains($text, 'Bienvenue') || str_contains($text, 'Bonjour') => 'fr',
    // ...
};

var_dump($result);

?>