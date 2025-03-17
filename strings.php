<?php
// adds backslash before 'w'
$a = addcslashes("Hello World!","W");
echo($a);

// backslash after each double quote
$b = addslashes('What does "yolo" mean?');
echo($b);

// convert to hexadecimal
$c = bin2hex("Hello World!");
echo($c);

//remove whitespaces from end.
$d = "Hello World!";
echo $d . "<br>";
echo chop($d,"World!");

// character value.
echo chr(38);

//split string.
echo chunk_split("Kabir",2,".");


//length of string.
echo count_chars("kabir",3);

// split string into array
$e = "kabir";
print_r(str_split($e));

// Join array elements with a string:
$arr = array('Hello','World!','Beautiful','Day!');
echo implode(" ",$arr);

$arr = array('Hello','World!','Beautiful','Day!');
echo join(" ",$arr);

// sha-1 hash of string
echo sha1("kabir");

// replace string str_replace(find,replace,string,count(optional))
$f = "kabir";
echo $f,"\n";
echo str_replace("kabir","navadiya",$f);


// randomly shuffles string
echo str_shuffle("Hello World");

// first occurence of string
echo strchr("Hello world!","world");

// compares strings case-insensitive (returs number of diff chars)
echo strcasecmp( "Hello world!s","HELLO WORLD!");

// Find the position of the first occurrence of "php" inside the string:
echo stripos("I love php, I love php too!","PHP");


// Convert all characters to lowercase:
echo strtolower("Hello WORLD.");

// Return "world" from the string:
echo substr("Hello world", 1,6);

// Count the number of times "world" occurs in the string:
echo substr_count("Hello world. The world is nice","world");


// Replace "Hello" with "world":
echo substr_replace("Hello","world",0,2);



echo 2<1 ?  1*2 :  "false" ;


?>