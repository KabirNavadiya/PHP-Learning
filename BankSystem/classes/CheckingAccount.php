<?php


class CheckingAccount extends BankAccount{

    public float $maxWithdrawl = 500;
    public function Deposit(float $amount){
        $this->balance += $amount;
        parent::Log($this->name,"deposited",$amount,__CLASS__);
        parent::$TotalTransactions++;
        
     }
    public function Withdraw(float $amount){
        if($amount > $this->maxWithdrawl){
            echo "You can withdraw only {$this->maxWithdrawl} at a time\n";
        }
        else{
            if($this->balance >= $this->minbalance + $amount){
                $this->balance -= $amount;
                echo "You withdraw {$amount} from your ".__CLASS__."\n";
                parent::Log($this->name,"Withdrawed",$amount,__CLASS__);
                parent::$TotalTransactions++;
            }
            else{
                echo "You cannot withdraw {$amount}, Your minimum balance must be {$this->minbalance} \n";
            }
        }
        
    }
}

?>