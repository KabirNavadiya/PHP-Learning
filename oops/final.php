<?php

// final method example

// class BaseClass{
//     public function test(){
//         echo "BaseClass::test() called \n";
//     }

//     final public function moreTest(){
//         echo "BaseClass::moreTest() called \n";
//     }
// }
// class ChildClass extends BaseClass{
 
//     // fatal error.  Cannot override final method BaseClass::moreTesting()
//     public function moreTest()
//     {
//         echo "ChildClass::moreTest() called \n";
//     }
// }

// final class example.

// final class BaseClass{
//     public function test(){
//         echo "BaseClass::test() called \n";
//     }

//     // as child is already final the final keyword is not needed with methods.
//     public function moreTest(){
//         echo "Baseclass::moreTest() called \n";
//     }

// }

// // results Fatal Error : cannot extend final class.
// class ChildClass extends Baseclass{

// }


//final property example.

// class BaseClass {
//     final protected string $test;
//  }
 
//  class ChildClass extends BaseClass {

//      // Results in Fatal error: Cannot override final property BaseClass::$test
//      public string $test;
//  }


// final constant example

// class Foo
// {
//     final public const X = "foo";
// }

// class Bar extends Foo
// {
//     // Fatal error: Bar::X cannot override final constant Foo::X
//     public const X = "bar";
// }


?>