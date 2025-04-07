<?php

declare(strict_types=1);

function checkLoginErrors()
{
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];
        echo "<br>";
        foreach ($errors as $err) {
            echo '<p style = "color:red"> ' . $err . '</p>';
        }
        unset($_SESSION["errors_login"]);
    } else if (isset($_GET['login']) && $_GET['login'] === "success") {
        echo '<p style = "color:green"> Login Success ! </p>';
    }
}

function getUsername()
{
    if (isset($_SESSION["user_id"])) {
        echo $_SESSION["user_username"];
    } else {
        echo "Login";
    }
}
