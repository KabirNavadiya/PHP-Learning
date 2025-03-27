<?php
spl_autoload_register(function ($class_name) {
    include 'Test/' . $class_name . '.php'; // Adjust path if needed
});
?>
