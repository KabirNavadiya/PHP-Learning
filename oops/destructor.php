<?php

class DestructorDemo{
    public $name;
    public $age;
    public function __construct($name,$age){
        $this->name = $name;
        $this->age = $age;
    }
    public function __destruct(){
        echo "Above is basic details about me\n";
    }
    public function get_details(){
        return ['name'=>$this->name,'age'=>$this->age];
    }

}

$constructor = new DestructorDemo("kabir",21);
print_r($constructor->get_details());
