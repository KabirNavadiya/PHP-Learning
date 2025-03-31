<?php

$myfile = fopen("fileHandling/sample.txt","r") or die ("unable to open the file");
echo fread($myfile,filesize("fileHandling/sample.txt"))."\n";
?>