<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $pwd = htmlspecialchars($_POST['password']);
    $confirm_pwd = htmlspecialchars($_POST['confirm-password']);
    $contact = htmlspecialchars($_POST['contact']);
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
            $errors["username_taken"] = "try different username !";
        }
        if (isEmailRegistered($conn, $email)) {
            $errors["email_used"] = "try different email!";
        }
        if($pwd !== $confirm_pwd){
            $errors["unmatched_pwd"]="Password does'nt match !";
        }
        if(!validateEmail($email)){
            $errors["invalid_email"]="Invalid Email !";
        }
        $passworderrormsg = validatePassword($pwd);
        if($passworderrormsg){
            $errors["invalid password"] = $passworderrormsg;
        }
        $contacherrormsg = validateContact($contact);

        if($contacherrormsg){
            $errors["invalid_contact"]= $contacherrormsg;
        }

        $isdate = is_numeric( strtotime( $dob ) ) ? "yes" : "no";
        if($isdate==="no"){
            $errors["invalid_date"]="invalid date";
        }


        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;
            header("Location: ../signup.php");
            die();
        }

        createUser( $conn, $email, $username, $pwd, $contact, $dob);
        $_SESSION['signup']="success";
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
