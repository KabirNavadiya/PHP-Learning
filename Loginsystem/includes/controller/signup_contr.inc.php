<?php

declare(strict_types=1);


function isInputEmpty(string $email,string $username,string $password,string $contact,string $dob){
    if(empty($username) || empty($email) || empty($password) || empty($contact) || empty($dob)){
        return true;
    }
    else{
        return false;
    }
}
function isEmailInvalid($email){
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else{
        return false;
    }
}
function isUserNameTaken(object $conn,string $username){
    if(getUsername($conn,$username)){
        return true;
    }
    else{
        return false;
    }
}
function isEmailRegistered(object $conn,string $email){
    if(getUserEmail($conn,$email)){
        return true;
    }
    else{
        return false;
    }
}
function createUser(object $conn,string $email,string $username,string $password,string $contact,string $dob){
    setUser($conn, $email, $username,$password,$contact,$dob);
}
