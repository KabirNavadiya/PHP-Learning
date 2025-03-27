<?php
// abstract class AbstractClass
// {
//     // Force extending class to define this method
//     abstract protected function getValue();
//     abstract protected function prefixValue($prefix);

//     // Common method
//     public function printOut()
//     {
//         print $this->getValue() . "\n";
//     }
// }

// class ConcreteClass1 extends AbstractClass
// {
//     protected function getValue()
//     {
//         return "ConcreteClass1";
//     }

//     public function prefixValue($prefix)
//     {
//         return "{$prefix}ConcreteClass1";
//     }
// }

// class ConcreteClass2 extends AbstractClass
// {
//     public function getValue()
//     {
//         return "ConcreteClass2";
//     }

//     public function prefixValue($prefix)
//     {
//         return "{$prefix}ConcreteClass2";
//     }
// }

// $class1 = new ConcreteClass1();
// $class1->printOut();
// echo $class1->prefixValue('FOO_'), "\n";

// $class2 = new ConcreteClass2();
// echo $class2->getValue(),"\n";
// echo $class2->prefixValue('FOO_'), "\n";




abstract class AbstractClass{
    abstract protected function prefixName($name);
}

class ConcreteClass extends AbstractClass{
    public function prefixName($name,$separator = '.'){
        if($name == 'Clark'){
            $prefix = 'Mr';
        }
        else if($name == 'Lane'){
            $prefix = 'Mrs';
        }
        else{
            $prefix = '';
        }

        return "{$prefix}{$separator} {$name}";
    }
}

$class = new ConcreteClass();
echo $class->prefixName("Clark"),"\n";
echo $class->prefixName("Lane"),"\n";

?>