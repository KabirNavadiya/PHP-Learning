<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] === "POST") {


    $username = $_POST['username'];
    $n_pwd = $_POST['new-password'];
    $c_pwd = $_POST['confirm-password'];

    try {
        require_once 'dbh.inc.php';
        require_once 'model/update_model.inc.php';
        require_once 'controller/update_contr.inc.php';


        $errors = [];
        if (isEmpty($username, $n_pwd, $c_pwd)) {
            $errors["empty_input"] = "fill in all fields";
        }
        if (isDifferent($n_pwd, $c_pwd)) {
            $errors["different_password"] = "Passwords do not match!";
        }
        $result = getUser($conn, $username);

        if (isUsernameWrong($result)) {
            $errors["username_incorrect"] = "User not found ! ";
        }
        if (password_verify($n_pwd, $result['pwd'])) {
            $errors["same_password"] = "Same as Old!";
        }

        require_once 'config_session.inc.php';
        
        if ($errors) {
            $_SESSION["errors_update"] = $errors;
            header('Location: ../updatepass.php');
            die();
        }
        $options = ['cost' => 12];
        $h_pwd = password_hash($n_pwd, PASSWORD_BCRYPT, $options);

        setPass($conn, $username, $h_pwd);
        header('Location: ../login.php');
        $conn = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die(" Query failed : " . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
    die();
}
