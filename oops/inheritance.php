<?php

class Foo
{
    public function printItem($string)
    {
        echo 'Foo: ' . $string ."\n";
    }
    
    public function printPHP()
    {
        echo 'PHP is great.' . "\n";
    }
}

class Bar extends Foo
{
    public function printItem($string)
    {
        echo 'Bar: ' . $string . "\n";
    }
}

$foo = new Foo();
$bar = new Bar();
$foo->printItem('baz'); // Output: 'Foo: baz'
$foo->printPHP();       // Output: 'PHP is great' 
$bar->printItem('baz'); // Output: 'Bar: baz'
$bar->printPHP();       // Output: 'PHP is great'

?>