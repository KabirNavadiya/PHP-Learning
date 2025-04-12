<?php

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != "admin") {
    header("Location: /login");
    die();
}

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header('Location: /admin');
    die();
}
