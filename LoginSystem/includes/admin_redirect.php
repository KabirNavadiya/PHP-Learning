<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    die();
}
if ($_SESSION['user_role'] != "admin") {
    header("Location: /");
    die();
}

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header('Location: /admin');
    die();
}
