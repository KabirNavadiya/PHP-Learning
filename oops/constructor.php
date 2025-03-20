<?php

class ConstructorDemo{
    public $name;
    public $age;
    public function __construct($name,$age){
        $this->name = $name;
        $this->age = $age;
    }
    public function get_details(){
        return ['name'=>$this->name,'age'=>$this->age];
    }
}

$constructor = new ConstructorDemo("kabir",21);
print_r($constructor->get_details());



// constructor example with inheritance.
class Baseclass{
    public function __construct(){
        echo "This is base constructor\n";
    }
}
class subClass extends Baseclass{
    public function __construct(){
        parent::__construct();
        echo "This is subClass constructor\n";
    }
}
$base = new Baseclass();
$subClass = new SUBClass(); // keywords are insensitive variable names are not.

?>