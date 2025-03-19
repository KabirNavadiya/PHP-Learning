<?php

function greeting() {
    echo "Hello world!";
  }
  
  greeting();


// parameterised function
  function familyName($fname) {
    echo "$fname Refsnes \n";
  }
  
  familyName("Jani");
  familyName("Hege");
  familyName("Stale");
  familyName("Kai Jim");
  familyName("Borge");


// default parameter
  function setHeight($minheight = 50) {
    echo "The height is : $minheight \n";
  }
  
  setHeight(350);
  setHeight(); // will use the default value of 50
  setHeight(135);
  setHeight(80);


  function sum($x, $y) {
    $z = $x + $y;
    return $z;
  }
  
  echo "5 + 10 = " . sum(5, 10) ,"\n";
  echo "7 + 13 = " . sum(7, 13) , "\n";
  echo "2 + 4 = " . sum(2, 4);


// Variable Number of Arguments
  function sumMyNumbers(...$x) {
    $n = 0;
    $len = count($x);
    for($i = 0; $i < $len; $i++) {
      $n += $x[$i];
    }
    return $n;
  }
  
  $a = sumMyNumbers(5, 2, 6, 2, 7, 7);
  echo $a;


  // variable functions.
function foo() {
    echo "In foo()\n";
}

function bar($arg = '')
{
    echo "In bar(); argument was '$arg'\n";
}

// This is a wrapper function around echo
function echoit($string)
{
    echo $string;
}

$func = 'foo';
var_dump($func());        // This calls foo()

$func = 'bar';
$func('test');  // This calls bar()

$func = 'echoit';
$func('test');  // This calls echoit()



// complex callables
class Foo
{
    static function bar()
    {
        echo "bar\n";
    }
    function baz()
    {
        echo "baz\n";
    }
}

$func = array("Foo", "bar");
$func(); // prints "bar"
$func = array(new Foo, "baz");
$func(); // prints "baz"
$func = "Foo::bar";
$func(); // prints "bar"



// variable variables

$Bar = "a";
$Foo = "Bar";
$World = "Foo";
$Hello = "World";
$a = "Hello";

echo $a, "\n"; //Returns Hello
echo $$a, "\n"; //Returns World
echo $$$a, "\n"; //Returns Foo
echo $$$$a, "\n"; //Returns Bar
echo $$$$$a, "\n"; //Returns a


// Anonymous function
$greet = function($name) {
  echo "Hello ! Good morning" . $name;
};
$greet(" Kabir");

// inheriting variables from parent scope

$message = "hello";
$example = function () use ($message) {
  echo($message);
};
$example();


// arrow functions
$y = 5;
$sum = fn($x) => $x + $y;
echo $sum(2);


// nested arrow function
$z = 1;
$fn = fn($x) => fn($y) => $x * $y + $z;
echo $fn(5)(10);
?>