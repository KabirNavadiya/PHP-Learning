<?php 
// $a_bool = true;
// $a_str = "Kabir";
// $b_str = 'Navadiya';
// $an_int = 26;

// // Returns only the type name
// echo get_debug_type($a_bool), "\n";
// echo get_debug_type($a_str), "\n";
// echo get_debug_type($b_str), "\n";

// if (is_int($an_int) == "int") {
//     $an_int ++;
// }

// // var_dump() is a PHP function that displays 
// // structured information about one or more variables, including their type and value. 
// var_dump($an_int);

// echo is_int($an_int)." ".$an_int, "\n";

// echo $an_int . "a", "\n";
// $var = NULL;
// var_dump($var);
// echo $an_int + $var, "\n";

// echo $a_str == $b_str , $a_str === $b_str;
// echo $var == null ," ",$var === null; 

// var_dump((bool) "");        // bool(false)
// var_dump((bool) "0");       // bool(false)
// var_dump((bool) 1);         // bool(true)
// var_dump((bool) -2);        // bool(true)
// var_dump((bool) "foo");     // bool(true)
// var_dump((bool) 2.3e5);     // bool(true)
// var_dump((bool) array(12)); // bool(true)
// var_dump((bool) array());   // bool(false)
// var_dump((bool) "false");   // bool(true)

// var_dump(PHP_INT_MAX );
// var_dump(round(25/7));
// echo intval(3.5);

// $x =(int) 124;
// $y = 0124;
// echo "\n", $x , " ", $y;


// echo "\nYou can also have embedded newlines in
// strings this way as it is
// okay to do \n" ;


// echo <<<END
//       a
//      b
//     c
// \n
// END;
// echo <<<END
//       a
//      b
//     c
//     \n
//     END;

// var_dump("0D1" == "000"); // false, "0D1" is not scientific notation
// var_dump("0E1" == "000"); // true, "0E1" is 0 * (10 ^ 1), or 0
// var_dump("2E1" == "020"); // true, "2E1" is 2 * (10 ^ 1), or 20



// $foo = 1 + "10.5";  
// echo "\n",$foo;             // $foo is float (11.5)
// $foo = 1 + "-1.3e3";              // $foo is float (-1299)
// echo "\n",$foo; 
// $foo = 1 + "10 Small Pigs";       // $foo is integer (11) and an E_WARNING is raised in PHP 8.0.0, E_NOTICE previously
// echo "\n",$foo; 
// $foo = 4 + "10.2 Little Piggies"; // $foo is float (14.2) and an E_WARNING is raised in PHP 8.0.0, E_NOTICE previously
// echo "\n",$foo; 
// $foo = "10.0 pigs " + 1;          // $foo is float (11) and an E_WARNING is raised in PHP 8.0.0, E_NOTICE previously
// echo "\n",$foo; 
// $foo = "10.0 pigs " + 1.0;        // $foo is float (11) and an E_WARNING is raised in PHP 8.0.0, E_NOTICE previously
// echo "\n",$foo; 


// $details = array(
//     "name"=> "kabir Navadiya",
//     "age"=> "21",
// );
// $array = array(
//     "a",
//     "b",
//     "c",
//     "d",
// );

// print_r($array);
// echo $array[0];

// echo $details["age"] ,"\n";
// $y = 1 + (int)"kabir 10.1" ;
// $x = 1 + (int)"10.1 kabir" ;
// $z = 1 + (int)"10.1 ka 10.1 bir" ;
// echo $y," ",$x," ",$z;

// // $k = [];
// // $k[-1] = 1;
// // echo $k[-1] ," ";



// [$a,$b,$c,$d] = $array;
// echo $a ," ",$b," ",$c," ",$d," ";

// $x1 = 1;
// $x2 = 2;
// echo "\n",$x1," ",$x2,"\n";
// [$x1,$x2] = [$x2,$x1];
// echo $x1," ",$x2,"\n";

// //objects
// $object1 = (object)array(
//     "name"=> "kabir",
//     "age"=> 21,
// );
// echo $object1 -> name ," ", $object1 -> age;



// $double = function($a) {
//     return $a * 2;
// };

// // This is our range of numbers
// $numbers = range(1, 5);

// // Use the closure as a callback here to
// // double the size of each element in our
// // range
// $new_numbers = array_map($double, $numbers);

// print_r( $new_numbers);

$foo = 'Bob';              // Assign the value 'Bob' to $foo
$bar = &$foo;              // Reference $foo via $bar.
$bar = "My name is $bar";  // Alter $bar...
echo $bar,"\t";
echo $foo;                 // $foo is altered too.

// $bar = &(24 * 7);  // Invalid; references an unnamed expression.


?>
