<?php


include("autoload.php");
// require("classes/BankAccount.php");
// require("classes/SavingsAccount.php");
// require("classes/CheckingAccount.php");

$accountA = new SavingsAccount("kabir",1,1500);
$accountB = new CheckingAccount("utsav",2,1500);
$accountA->Deposit(100);
$accountA->Deposit(100);
$accountA->Deposit(100);
$accountA->Deposit(100);
$accountA->Deposit(100);
$accountB->Deposit(100);
$accountA->Withdraw(500);
$accountB->Withdraw(600);
echo "Current balance of {$accountA->getname()} : ",$accountA->getBalance(),"\n";
echo "Current balance {$accountB->getname()} :",$accountB->getBalance(),"\n";
echo "TotalAccounts : ",BankAccount::getTotalAccount(),"\n";
echo "TotalTransactions : ",BankAccount::getTotalTransactions(),"\n";

?>