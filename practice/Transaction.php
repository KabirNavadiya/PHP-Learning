<?php

namespace practice;

class Transaction
{
    public $user;
    public $amount;
    public $type;

    public function __construct($user, $amount, $type)
    {
        $this->user = $user;
        $this->amount = $amount;
        $this->type = $type;
    }
}
