<?php

readonly class User {
    public function __construct(
        public string $name,
        public int $age
    ) {}
}
$user = new User("Kabir", 25);
echo $user->name,"\n"; // Output: Kabir
echo $user->age,"\n";  // Output: 25
$user->name = "utsav"; // error
// This will cause an error because properties cannot be modified after initialization