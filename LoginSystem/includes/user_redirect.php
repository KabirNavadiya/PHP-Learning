<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
} else {
    header("Location: /");
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    die();
}
