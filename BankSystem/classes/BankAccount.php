<?php

include "logger.php";
abstract class BankAccount{

    protected $accountNumber;
    protected $name;
    protected $balance = 0;
    protected $minbalance = 1000;
    public static $TotalAccounts = 0;
    public static $TotalTransactions = 0;

    use Logger;
    public function __construct(string $name,int $accountNumber,float $balance){
        $this->accountNumber=$accountNumber;
        $this->balance = $balance;
        $this->name = $name;
        self::$TotalAccounts++;

    }

    public function getBalance(){
        return $this->balance;
    }

    public static function getTotalAccount(){
        return self::$TotalAccounts;
    }
    public static function getTotalTransactions(){
        return self::$TotalTransactions;
    }
    protected abstract function Withdraw(float $amount);
    protected abstract function Deposit(float $amount);

}

?>
