<?php

trait Logger
{
    public function Log($user, $action, $amount, $bank)
    {
        $myfile = fopen("BankSystem/logs.log", "a") or die("Unable to open file!");
        fwrite($myfile, "User : {$user} , {$action} {$amount} in their {$bank} \n");
        fclose($myfile);
        BankAccount::$TotalTransactions++;
    }
    
    public function LogUseradd($user,$balance,$bank)
    {
        $myfile = fopen("BankSystem/logs.log", "a") or die("Unable to open file!");
        fwrite($myfile, "User : {$user} , created their new {$bank} with balance {$balance} \n");
        fclose($myfile);
        BankAccount::$TotalAccounts++;
    }
    public function LogError($amount,$action,$bank){
        $myfile = fopen("BankSystem/logs.log", "a") or die("Unable to open file!");
        fwrite($myfile, "Error occured while {$action} {$amount} from {$bank} \n");
        fclose($myfile);
    }

}
