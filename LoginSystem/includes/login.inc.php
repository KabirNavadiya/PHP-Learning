<?php

session_start();
require_once 'user_redirect.php';

$username = htmlspecialchars($_POST['username']);
$pwd = htmlspecialchars($_POST['password']);

try {
    require_once 'config_session.inc.php';
    require_once '../dbh.inc.php';
    require_once 'model/login_model.inc.php';
    require_once 'controller/login_contr.inc.php';

    $errors = [];
    if(empty($username)){
        $errors["empty_username"] = "Please enter username or email";

    }
    if(empty($pwd)){
        $errors["empty_password"] = "Please enter password";
    }
    $result = getUser($conn, $username);
    if(!empty($username) && !empty($pwd)){
        if (isUsernameWrong($result)) {
            $errors["login_incorrect"] = "User not found ! ";
        }
        if (!isUsernameWrong($result) && isPasswordWrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Incorrect credentials !";
        }
    }

    if ($errors) {
        $_SESSION["errors_login"] = $errors;
        header("Location: /login");
        die();
    }
    function generateSessionId($result)
    {
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION["user_role"] = $result['role'];
        $_SESSION["last_regeneration"] = time();
    }

    if (isAdmin($result['role'])) {
        generateSessionId($result);
        $conn = null;
        $stmt = null;
        header("Location: /");
        die();
    } else {
        generateSessionId($result);
        $conn = null;
        $stmt = null;
        header("Location: /");
        die();
    }
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
