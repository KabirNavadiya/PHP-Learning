<?php

trait Logger{
    public function Log($user,$action,$amount,$bank){
        $myfile=fopen("BankSystem/logs.log","a") or die("Unable to open file!");
        fwrite($myfile,"User : {$user} , {$action} {$amount} in their {$bank} \n");
    }
}


?>