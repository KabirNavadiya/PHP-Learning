<?php

function bool2str($bool){
    if($bool === false){
        return 'FALSE';
    }else{
        return 'TRUE';
    }
}

function compareObjects(&$o1, &$o2){
    echo 'o1 == o2 : '.bool2str($o1 == $o2)."\n";
    echo 'o1 != o2 : '.bool2str($o1 != $o2)."\n";
    echo 'o1 === o2 : '.bool2str($o1 === $o2)."\n";
    echo 'o1 !== o2 : '.bool2str($o1 !== $o2)."\n";
}


class Flag{
    public $flag;
    function __construct($flag = true){
        $this->flag = $flag;
    }
}
class OtherFlag{
    public $flag;
    function __construct($flag = true){
        $this->flag = $flag;
    }
}

$o = new Flag();
$p = new Flag();
$q = $o;
$r = new OtherFlag();
echo  "Two instances of he same class \n";
compareObjects($o,$p);

echo "\n Two references to the same instance \n";
compareObjects($o,$q);

echo "\n Instances of two different classses \n";
compareObjects($o,$r);


?>