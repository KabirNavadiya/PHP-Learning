<?php


// $myfile = fopen("fileHandling/sample.txt","w") or die ("unable to create the file! ");
// $text = readline();
// fwrite($myfile, $text);
// fclose($myfile);


$myfile = fopen("fileHandling/sample.txt","a") or die ("unable to create the file! ");
$text = readline();
fwrite($myfile, $text."\n");
fclose($myfile);


?>