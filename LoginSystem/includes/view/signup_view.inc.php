<?php

declare(strict_types=1);

// session_start(); 

function checkSignupErrors() {
    if (isset($_SESSION["errors_signup"])) {
        $errors = $_SESSION["errors_signup"];

        foreach ($errors as $key => $err) {
            echo '<p style = "color:red">' . $err . '</p>';
        }
        
        unset($_SESSION["errors_signup"]);
    }
    else if(isset($_SESSION["signup"]) && $_SESSION["signup"] === "success"){
        echo '<p style = "color:green">Signup Success ! </p>';
    }
}

