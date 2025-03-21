<?php

interface Template{
    public function setvariable($name,$var);
    public function getHtml($template);
}

class WorkingTemplate implements Template{
    private $vars = [];
    public function setVariable($name,$var){
        $this->vars[$name] = $var;
    }
    public function getHtml($template){
        foreach($this->vars as $name => $value){
            $template = str_replace('{'.$name.'}',$value,$template);
        }

        return $template;
    }
}

$obj1 = new WorkingTemplate();
$obj1->setVariable('kabir','1');
$obj1->setVariable('utsav','2');
echo $obj1->getHtml('{kabir}'),"\n";
echo $obj1->getHtml('{utsav}'),"\n";

// below block will not work because it contains only 1 abstract method
// must contain all the methods from interface.
// class BadTemplate implements Template{
//     private $vars = [];
//     public function setVariable($name,$var){
//         $this->vars[$name] = $var;
//     }
// }



// extend multiple interfaces

interface A{
    public function A();
}
interface B{
    public function B();
}
interface C extends A,B{
    public function C();
}

class MyClass implements C{
    public function A(){
        echo "A\n";
    }
    public function B(){
        echo "B\n";
    }
    public function C(){
        echo "C\n";
    }
}

$myclass = new MyClass();
$myclass->A();
$myclass->B();
$myclass->C();

?>