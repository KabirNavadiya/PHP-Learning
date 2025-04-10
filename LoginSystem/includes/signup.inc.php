<?php

session_start();

require_once 'user_redirect.php';

$username = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email']);
$pwd = htmlspecialchars($_POST['password']);
$confirm_pwd = htmlspecialchars($_POST['confirm-password']);
$contact = htmlspecialchars($_POST['contact']);
$dob = $_POST['dob'];

try {

    require_once 'config_session.inc.php';
    require_once '../dbh.inc.php';
    require_once 'model/signup_model.inc.php';
    require_once 'controller/signup_contr.inc.php';

    $errors = [];
    if(empty($username)){
        $errors['empty_username']= "please enter username";
    }
    if(empty($email)){
        $errors['empty_email']= "please enter email";
    }
    if(empty($pwd)){
        $errors['empty_password']= "please enter password";
    }
    if(empty($confirm_pwd)){
        $errors['empty_confirmpwd']= "please enter password";
    }
    if(empty($contact)){
        $errors['empty_contact']= "please enter contact";
    }
    if(empty($dob)){
        $errors['empty_dob']= "please enter date-of-birth";
    }
    
    if(!empty($username) && !empty($email) && !empty($pwd) && !empty($confirm_pwd) && !empty($contact) && !empty($dob)){

        if (isEmailInvalid($email)) {
            $errors["invalid_email"] = "invalid email used!";
        }
        if (isUserNameTaken($conn, $username)) {
            $errors["username_taken"] = "try different username !";
        }
        if (isEmailRegistered($conn, $email)) {
            $errors["email_used"] = "try different email!";
        }
        if ($pwd !== $confirm_pwd) {
            $errors["unmatched_pwd"] = "Password does'nt match !";
        }
        $passworderrormsg = validatePassword($pwd);
        if ($passworderrormsg) {
            $errors["invalid_password"] = $passworderrormsg;
        }
        $contacherrormsg = validateContact($contact);
        if ($contacherrormsg) {
            $errors["invalid_contact"] = $contacherrormsg;
        }
        
        $isdate = is_numeric(strtotime($dob)) ? "yes" : "no";
        if ($isdate === "no") {
            $errors["invalid_date"] = "invalid date";
        }
    }
        
        if ($errors) {
            $_SESSION["errors_signup"] = $errors;
        header("Location: /signup");
        die();
    }

    createUser($conn, $email, $username, $pwd, $contact, $dob);
    $_SESSION['signup'] = "success";
    $conn = null;
    $stmt = null;
    header('Location: /login');
    die();
} catch (PDOException $e) {
    die(" Query failed : " . $e->getMessage());
}
