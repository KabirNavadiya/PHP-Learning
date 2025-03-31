<?php

namespace practice;

use function PHPSTORM_META\type;

include "Transaction.php";
class User
{
    public $name;
    public $transactions = [];
    public function __construct($name)
    {
        $this->name = $name;
    }
    public function add_transactions($transactions)
    {
        $this->transactions[] = $transactions;
    }
    public function get_transactions()
    {
        return $this->transactions;
    }
    public function get_name(){
        return $this->name;
    }

    public function largest_transaction(){
        $largest = 0;
        foreach ($this->transactions as $transaction){
            if($transaction->amount > $largest){
                $largest = $transaction->amount;
            }
        }
        return $largest."(".$transaction->type.")";   
    }

    public function get_deposits(){
        $deposit = 0;
        foreach ($this->transactions as $transaction){
            if($transaction->type == "deposit"){
                $deposit += $transaction->amount;
            }
        }
        return $deposit;
    }
    public function get_withdrawals(){
        $withdrawal=0;
        foreach ($this->transactions as $transaction){
            if($transaction->type == "withdrawal"){
                $withdrawal += $transaction->amount;
            }
        }
        return $withdrawal;
    }

}
