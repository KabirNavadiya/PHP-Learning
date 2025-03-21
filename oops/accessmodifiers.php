<?php
class Class1 {
    public string $publicVar = "I am public class1";        // Accessible anywhere
    protected string $protectedVar = "I am protected class1"; // Accessible in this class & child classes
    private string $privateVar = "I am private class1";      // Only accessible in this class

    public function showPrivateVar() {
        return $this->privateVar." from function"; // Private variable can be accessed inside this class
    }
}

class Class2 extends Class1 {
    public function showVariables() {
        echo $this->publicVar , "\n";     // ✅ Accessible (public)
        echo $this->protectedVar , "\n";  // ✅ Accessible (protected)
        
        // ❌ Private variable is NOT accessible in child class
        // echo $this->privateVar; // This will cause an ERROR
    }
}

$obj = new Class2();
$obj->showVariables(); // Displays public and protected variables

echo $obj->publicVar , "\n"; // ✅ Public variable can be accessed outside
// echo $obj->protectedVar; // ❌ ERROR: Protected variable can't be accessed outside class
// echo $obj->privateVar;   // ❌ ERROR: Private variable can't be accessed at all

// Accessing private variable through a public method in Class1
echo $obj->showPrivateVar(),"\n"; // ✅ Works because it's accessed inside Class1
?>
