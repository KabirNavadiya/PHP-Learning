<?php

require_once 'user_redirect.php';
require_once 'config_session.inc.php';
require_once '../dbh.inc.php';
require_once 'model/login_model.inc.php';
require_once 'controller/login_contr.inc.php';
session_start();

$username = htmlspecialchars($_POST['username']);
$pwd = htmlspecialchars($_POST['password']);

try {
    $errors = [];
    if (empty($username)) {
        $errors["empty_username"] = "Please enter username or email";
    }
    if (empty($pwd)) {
        $errors["empty_password"] = "Please enter password";
    }
    if (!$errors) {
        $result = getUser($conn, $username);
        if (isUsernameWrong($result)) {
            $errors["login_incorrect"] = "User not found!";
        } elseif (isPasswordWrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Incorrect credentials!";
        }
    }

    if ($errors) {
        $_SESSION["errors_login"] = $errors;
        header("Location: /login");
        die();
    }
    function generateSessionId($result)
    {
        session_id(session_create_id() . "_" . $result["id"]);
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION["user_role"] = $result['role'];
        $_SESSION["last_regeneration"] = time();
    }

    generateSessionId($result);
    $conn = null;
    $stmt = null;
    header("Location: /");
    exit();
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
