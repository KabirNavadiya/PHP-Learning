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
