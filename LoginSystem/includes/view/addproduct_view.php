<?php


declare(strict_types=1);
function checkAddProductErrors() {
    if (isset($_SESSION["errors_addproduct"])) {
        $errors = $_SESSION["errors_addproduct"];

        foreach ($errors as $err) {
            echo '<p style = "color:red">' . $err . '</p>';
        }
        
        unset($_SESSION["errors_addproduct"]);
    }
}