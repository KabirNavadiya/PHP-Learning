<?php

class SavingsAccount extends BankAccount
{

    public function Deposit(float $amount)
    {
        $this->balance += $amount;
        parent::Log($this->name, "deposited", $amount, __CLASS__);
        
        
    }
    public function Withdraw(float $amount)
    {

        if ($this->balance >= $this->minbalance + $amount) {
            $this->balance -= $amount;
            echo "You withdraw {$amount} from your " . __CLASS__ . "\n";
            parent::Log($this->name, "Withdrawed", $amount, __CLASS__);
        } else {
            echo "You cannot withdraw {$amount}, Your minimum balance must be {$this->minbalance} \n";
            parent::LogError($amount,__FUNCTION__."ing",__CLASS__);
        }
    }
}
