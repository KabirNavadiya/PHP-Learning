<?php

namespace Practice;

use practice\Transaction;
// use practice\User;
include "user.php";
// $user = new User("kabir");
$transactions = [
    new Transaction("Alice", 200, "deposit"),
    new Transaction("Bob", 50, "withdrawal"),
    new Transaction("Alice", 100, "deposit"),
    new Transaction("Bob", 30, "deposit")
];

$users = [];

foreach ($transactions as $transaction) {
    if (!isset($users[$transaction->user])) {
        $users[$transaction->user] = new User($transaction->user);
    }
    $users[$transaction->user]->add_transactions($transaction);
}


foreach($users as $user) {
    echo $user->get_name(),"\n";
    echo "-------------------------------\n";
    echo "Largest Transaction : ",$user->largest_transaction(),"\n";
    echo "Total Deposit : ",$user->get_deposits(),"\n";
    echo "Total Withdrawal : ",$user->get_withdrawals(),"\n";
    echo "Balance : ", $user->get_deposits() - $user->get_withdrawals(),"\n";
    echo "-------------------------------\n";
}

