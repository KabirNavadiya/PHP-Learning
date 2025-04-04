<?php

require_once 'includes/config_session.inc.php';
require_once 'includes/view/signup_view.inc.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="signup-box">
        <form class="signup-form" action="includes/signup.inc.php" method="post">
            <h1>Sign Up</h1>
            <div class="inputs">
                <input type="email" id="email" name="email" placeholder="Email">
            </div>
            <div class="inputs">
                <input type="text" id="username" name="username" placeholder="Username">
            </div>
            <div class="inputs">
                <input type="password" id="password" name="password" placeholder="Password">
                <i id="show" class="bi bi-eye"></i>
            </div>
            <div class="inputs">
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm-password">
            </div>
            <div class="inputs">
                <input type="tel" id="contact" name="contact" placeholder="9662*****4" pattern="[0-9]{10}">
            </div>

            <label for="dob"> Date of Birth :</label>
            <div class="inputs">
                <input type="date" id="dob" name="dob" placeholder="" min="2000-01-01" max="2024-12-31">
            </div>


            <div class="checkbox">
                <input type="checkbox" name="remember" id="remember" required>
                <label for="remember"> I accept Terms & Conditions</label>
            </div>
            <button type="submit" id="submit"> Register</button>
            <div class="footer">
                Already Registered ? <a href="login.php" style="text-decoration: none;"> Sign-In</a>
            </div>
        </form>

        <?php
        checkSignupErrors();
        unset($_SESSION['signup']);
        ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $("#show").click(function(){
            var ptype = document.getElementById("password");
            if(ptype.type==="password"){
                ptype.type = "text";
            }
            else{
                ptype.type = "password";
            }
        });
    </script>
</body>

</html>