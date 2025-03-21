<?php

class Fruit{

    public $name;
    public $color;

    function set_details($name,$color){ 
        $this->name = $name;
        $this->color = $color;
    }
    function get_details(){
        return ['name'=>$this->name,'color'=> $this->color];
    }
}
$fruit = new Fruit();
$fruit->set_details("apple",'red');
$details = $fruit->get_details();
echo  $details['color']. " " .$details['name'];
// var_dump($fruit instanceof Fruit);