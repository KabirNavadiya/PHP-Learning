<?php

declare(strict_types=1);
function checkUpdateErrors()
{
    if (isset($_SESSION["errors_update"])) {
        $errors = $_SESSION["errors_update"];
        echo "<br>";
        foreach ($errors as $err) {
            echo '<p style = "color:red"> ' . $err . '</p>';
        }
        unset($_SESSION["errors_update"]);
    }
}
