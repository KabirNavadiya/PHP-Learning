<?php


// Covariance


// abstract class Animal{
//     protected string $name;

//     public function __construct(string $name){
//         $this->name = $name;

//     }

//     abstract public function speak();
// }

// class Dog extends Animal{
//     public function speak(){
//         echo $this->name . " barks";
//     }
// }

// class Cat extends Animal{
//     public function speak(){
//         echo $this->name . " meows";
//     }
// }

// interface AnimalShelter{
//     public function adopt(string $name):Animal;
// }
// class CatShelter implements AnimalShelter{

//     // instead of returning class type Animal, it can return class type Cat.
//     public function adopt(string $name):Cat{
//         return new Cat($name);
//     }
// }

// class DogShelter implements AnimalShelter{

//     // instead of returning class type Animal, it can return class type Dog.
//     public function adopt(string $name):Dog{
//         return new Dog($name);
//     }
// }


// // $kitty = (new CatShelter) -> adopt("Ricky");
// $kitty->speak();
// echo "\n";

// $doggy = (new DogShelter) -> adopt("Mavrick");
// $doggy->speak();
// echo "\n";




// Explanation

// The AnimalShelter interface specifies that adopt() must return an Animal.
// In CatShelter, adopt() returns a more specific type (Cat instead of Animal).
// In DogShelter, adopt() returns a more specific type (Dog instead of Animal).
// This is covariance because the return type is more specific in the subclass.



// conravariance.

class Food {}

class AnimalFood extends Food{}

abstract class Animal{
    protected string $name;
    public function __construct(string $name){
        $this->name = $name;
    }
    public function eat(AnimalFood $food){
        echo $this->name . " eats " . get_class($food);
    }
}

class Cat extends Animal{
    public function speak(){
        echo $this->name . " meows";
    }
}

interface AnimalShelter{
    public function adopt(string $name):Animal;
}

class CatShelter implements AnimalShelter{

    // instead of returning class type Animal, it can return class type Cat.
    public function adopt(string $name):Cat{
        return new Cat($name);
    }
}

class DogShelter implements AnimalShelter{

    // instead of returning class type Animal, it can return class type Dog.
    public function adopt(string $name):Dog{
        return new Dog($name);
    }
}


// $kitty = (new CatShelter) -> ado

class Dog extends Animal{
    public function eat(Food $food){
        echo $this->name . " eats " . get_class($food);
    }
}

$kitty = (new Catshelter) -> adopt("Ricky");
$catFood = new AnimalFood();
$kitty -> eat($catFood);
echo "\n";


$doggy = (new DogShelter) -> adopt("Mavrick");
$banana = new Food();
$doggy -> eat($banana);
echo "\n";

?>
