<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    die();
}
