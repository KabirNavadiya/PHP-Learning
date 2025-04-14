<?php

require_once 'user_redirect.php';
require_once 'config_session.inc.php';
require_once '../dbh.inc.php';
require_once 'model/update_model.inc.php';
require_once 'controller/update_contr.inc.php';
session_start();

$email = $_POST['email'];
$n_pwd = $_POST['new-password'];
$c_pwd = $_POST['confirm-password'];

try {
    $errors = [];
    if (isEmpty($email, $n_pwd, $c_pwd)) {
        $errors["empty_input"] = "fill in all fields";
    } else if (isDifferent($n_pwd, $c_pwd)) {
        $errors["different_password"] = "Passwords do not match!";
    } else {
        $result = getUser($conn, $email);
        if (!$result || isUsernameWrong($result)) {
            $errors["no_user"] = "No user found with this email.";
        } elseif (password_verify($n_pwd, $result['pwd'])) {
            $errors["same_password"] = "New password cannot be the same as the old password.";
        } else {
            $passworderrormsg = validatePassword($n_pwd);
            if ($passworderrormsg) {
                $errors["invalid_password"] = $passworderrormsg;
            }
        }
    }

    if ($errors) {
        $_SESSION["errors_update"] = $errors;
        header('Location: /updatepass');
        die();
    }
    $options = ['cost' => 12];
    $h_pwd = password_hash($n_pwd, PASSWORD_BCRYPT, $options);

    setNewPassword($conn, $email, $h_pwd);
    $conn = null;
    $stmt = null;
    header('Location: /login');
    die();
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
