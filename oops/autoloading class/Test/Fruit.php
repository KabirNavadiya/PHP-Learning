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
