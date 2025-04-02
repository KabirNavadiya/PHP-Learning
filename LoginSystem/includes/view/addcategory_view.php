<?php


declare(strict_types=1);
function checkAddProductErrors() {
    if (isset($_SESSION["errors_addcategory"])) {
        $errors = $_SESSION["errors_addcategory"];

        foreach ($errors as $err) {
            echo '<p style = "color:red">' . $err . '</p>';
        }
        
        unset($_SESSION["errors_addcategory"]);
    }
}