<?php
// while loop 
$i = 1;
while ($i < 6) {
  echo $i,"\n";
  $i++;
}


// do-while loop
$i = 1;
do {
  echo $i;
  $i++;
} while ($i < 0);


// for loop
for ($x = 0; $x <= 10; $x++) {
    if ($x == 3) break;
    echo "The number is: $x \n";
}


// for each loop
$colors = array("red", "green", "blue", "yellow");

foreach ($colors as $x) {
  echo "$x \n";
}


$members = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");

foreach ($members as $x => $y) {
  echo "$x : $y \n";
}
?>