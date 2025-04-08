<?php

require_once 'includes/config_session.inc.php';
require_once 'includes/view/signup_view.inc.php';
$errors = signupErrors();
if (isset($_SESSION['user_id'])) {
    header("Location: /");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link rel="stylesheet" href="css/authentication.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="signup-box">
        <form class="signup-form" action="includes/signup.inc" method="post">
            <h1>Sign Up</h1>
            <div class="inputs">
                <input type="email" id="email" name="email" placeholder="Email">
                <span class="error" id="empty_email"><?= $errors['empty_email'] ?></span><br>
                <span class="error" id="invalid_email"><?= $errors['invalid_email'] ?></span><br>
                <span class="error" id="email_used"><?= $errors['email_used'] ?></span>
            </div>
            <div class="inputs">
                <input type="text" id="username" name="username" placeholder="Username">
                <span class="error" id="empty_username"><?= $errors['empty_username'] ?></span><br>
                <span class="error" id="username_taken"><?= $errors['username_taken'] ?></span>
            </div>
            <div class="inputs">
                <input type="password" id="password" name="password" placeholder="Password">
                <i id="show" class="bi bi-eye" style="top: 35%"></i>
                <span class="error" id="empty_password"><?= $errors['empty_password'] ?></span><br>
                <span class="error" id="unmatched_pwd"><?= $errors['unmatched_pwd'] ?></span><br>
                <span class="error" id="invalid_password"><?= $errors['invalid_password'] ?></span>
            </div>
            <div class="inputs">
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm-password">
                <span class="error" id="empty_confirmpwd"><?= $errors['empty_confirmpwd'] ?></span>
            </div>
            <div class="inputs">
                <input type="tel" id="contact" name="contact" placeholder="9662*****4" pattern="[0-9]{10}">
                <span class="error" id="empty_contact"><?= $errors['empty_contact'] ?></span><br>
                <span class="error" id="invalid_contact"><?= $errors['invalid_contact'] ?></span>
            </div>

            <label for="dob"> Date of Birth :</label>
            <div class="inputs">
                <input type="date" id="dob" name="dob" placeholder="" min="2000-01-01" max="2024-12-31">
                <span class="error" id="empty_dob"><?= $errors['empty_dob'] ?></span><br>
                <span class="error" id="invalid_date"><?= $errors['invalid_date'] ?></span>
            </div>


            <div class="checkbox">
                <input type="checkbox" name="remember" id="remember" required>
                <label for="remember"> I accept Terms & Conditions</label>
            </div>
            <button type="submit" id="submit"> Register</button>
            <div class="footer">
                Already Registered ? <a href="/login" style="text-decoration: none;"> Sign-In</a>
            </div>
        </form>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $("#show").click(function() {
            var ptype = document.getElementById("password");
            if (ptype.type === "password") {
                ptype.type = "text";
            } else {
                ptype.type = "password";
            }
        });
    </script>
</body>

</html>