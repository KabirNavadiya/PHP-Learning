<?php

trait Logger
{
    public function Log($user, $action, $amount, $bank)
    {
        $myfile = fopen("BankSystem/logs.log", "a") or die("Unable to open file!");
        fwrite($myfile, "User : {$user} , {$action} {$amount} in their {$bank} \n");
        BankAccount::$TotalTransactions++;
    }

    public function Loguseradd($user,$balance,$bank)
    {
        $myfile = fopen("BankSystem/logs.log", "a") or die("Unable to open file!");
        fwrite($myfile, "User : {$user} , created their new account with balance {$balance} in {$bank}  \n");
        BankAccount::$TotalAccounts++;
    }
    public function LogError($amount,$action,$bank){
        $myfile = fopen("BankSystem/logs.log", "a") or die("Unable to open file!");
        fwrite($myfile, "Error occured while {$action} {$amount} from {$bank} \n");
    }

}
