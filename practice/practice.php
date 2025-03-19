
<?php

$transactions = [
    ['id' => 1, 'user' => 'Alice', 'amount' => 100, 'type' => 'deposit'],
    ['id' => 2, 'user' => 'Bob', 'amount' => 50, 'type' => 'withdrawal'],
    ['id' => 3, 'user' => 'Alice', 'amount' => 200, 'type' => 'deposit'],
    ['id' => 4, 'user' => 'Bob', 'amount' => 30, 'type' => 'deposit'],
];

$groupby = function($value) use($transactions){
    $arr = array();
    foreach ($transactions as $key => $item) {
        $arr[$item[$value]][$key] = $item;
    }
    return $arr;
};

function uniqueUsers($transactions){
    $users = array_unique(array_column($transactions, "user"));
    return $users;
};
function uniquetype($transactions){
    $types = array_unique(array_column($transactions, "type"));
    return $types;
};

$users = uniqueUsers($transactions);
$types = uniquetype($transactions);
$groupby_user = $groupby('user');
$groupby_type = $groupby('type');


function largetestTransaction($users,$groupby_user){
    $amount = array('Alice'=> 0,'Bob'=>0);
    foreach ($users as $user) {
        $amount[$user] = max(array_unique(array_column($groupby_user[$user], 'amount')));
    }
    return $amount;
}

$transaction = largetestTransaction($users,$groupby_user);


function totaldepositsandwithdrawls($groupby_user){
    $totalamount = array('Alice'=>['deposit'=>0,'withdrawal'=>0],'Bob'=>['deposit'=>0,'withdrawal'=>0]);
    foreach ($groupby_user as $user) {
        foreach($user as $u){
            if ($u['type']== 'deposit') {
                $totalamount[$u['user']]['deposit']+=$u['amount'];
            }
            if ($u['type']== 'withdrawal') {
                $totalamount[$u['user']]['withdrawal']+=$u['amount'];
            }
        }
    }
    return $totalamount;
}
$totalamount = totaldepositsandwithdrawls($groupby_user);
