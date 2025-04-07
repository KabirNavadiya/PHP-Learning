<?php

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header('Location: ../admin.php');
    die();
}
