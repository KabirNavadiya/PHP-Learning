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
?>