<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/view/login_view.inc.php';
if (isset($_SESSION['user_id'])) {
    header("Location: /");
}
$errors = loginErrors();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/authentication.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="login-box">
        <form action="includes/login.inc" method="POST" class="login-form">
            <h1>Login</h1>
            <div class="inputs">
                <input type="text" id="username" name="username" placeholder="username or email">
                <span class="error" id="empty_username"><?= $errors['empty_username'] ?></span>
            </div>
            <div class="inputs">
                <input type="password" id="password" name="password" placeholder="password">
                <i id="show" class="bi bi-eye"></i>
                <span class="error" id="empty_password"><?= $errors['empty_password'] ?></span>
            </div>

            <a href="updatepass.php">Forgot Password ?</a>

            <div class="checkbox">
                <input type="checkbox" name="remember" id="remember" required>
                <label for="remember"> Remember me</label>
            </div>

            <button> Login</button>
            <span class="error" id="login_incorrect"><?= $errors['login_incorrect'] ?></span>
            <div class="footer">
                Not a user ? <a href="/signup" class="transition-link" style="text-decoration: none;"> Sign Up</a>
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