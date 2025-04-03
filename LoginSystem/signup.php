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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/signup.css">

</head>

<body>
    <div class="login-box">
        <form class="login-form" action="includes/signup.inc.php" method="post">
            <h1>Sign Up</h1>
            <div class="inputs">
                <input type="email" id="email" name="email" placeholder="Email">
            </div>
            <div class="inputs">
                <input type="text" id="username" name="username" placeholder="Username">

            </div>
            <div class="inputs">
                <input type="password" id="password" name="password" placeholder="Password">
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
            <button type="submit"> Register</button>
            <div class="footer">
                Already Registered ? <a href="login.php" style="text-decoration: none;"> Sign-In</a>
            </div>
        </form>

        <?php
        checkSignupErrors();
        ?>

    </div>




</body>

</html>