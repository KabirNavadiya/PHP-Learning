<?php

trait log{
    public function logmessage($message){
        echo $message;
    }
}

class savingsAccount{
    use log;

    public function log($message){
        echo $message,"\n";
    }
}

class checkingAccount{
    use log;
    public function log($message){
        echo $message,"\n";
    }
}


$sa = new savingsAccount();
$ca = new checkingAccount();

$sa->log("deposited $500 in tour account");
$ca->log("cannot not withdraw more than $50 at a time");
?>