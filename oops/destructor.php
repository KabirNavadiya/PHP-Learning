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


// destructor.

class MyDestructableClass 
{
    function __construct() {
        print "In constructor\n";
    }

    // automatically called upon end for script.
    function __destruct() {
        print "Destroying " . __CLASS__ . "\n";
    }
}

$obj = new MyDestructableClass();

?>
