<?php

// session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $contact = $_POST['contact'];
    $dob = $_POST['dob'];

    try {
        require_once 'dbh.inc.php';
        require_once 'model/signup_model.inc.php';
        require_once 'controller/signup_contr.inc.php';

        // ERROR HANDLERS.

        $errors = [];
        if (isInputEmpty($email, $username, $pwd, $contact, $dob)) {
            $errors["empty_input"] = "fill in all fields";
        }
        if (isEmailInvalid($email)) {
            $errors["invalid_email"] = "invalid email used!";
        }
        if (isUserNameTaken($conn, $username)) {
            $errors["username_taken"] = "Username already taken!";
        }
        if (isEmailRegistered($conn, $email)) {
            $errors["email_used"] = "email already registered!";
        }

        

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;
            header("Location: ../signup.php");
            die();
        }

        createUser( $conn, $email, $username, $pwd, $contact, $dob);
        header('Location: ../signup.php');

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
