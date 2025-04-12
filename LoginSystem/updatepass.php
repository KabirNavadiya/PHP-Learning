<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/view/update_view.inc.php';
require_once 'includes/user_redirect.php';
$errors = updateErrors();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="login-box">
        <form action="includes/update.inc" method="POST" class="login-form">
            <h1>update password</h1>
            <div class="inputs">
                <input type="text" id="email" name="email" placeholder="email">
                <span class="error" id="empty_input"><?= $errors['empty_input'] ?></span>
            </div>
            <div class="inputs">
                <input type="password" id="new-password" name="new-password" placeholder="New password">
                <span class="error" id="empty_input"><?= $errors['empty_input'] ?></span>
                <span class="error" id="different_password"><?= $errors['different_password'] ?></span>
                <span class="error" id="invalid_password"><?= $errors['invalid_password'] ?></span>
            </div>
            <div class="inputs">
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm password">
            </div>
            <button> Update</button>
            <span class="error" id="empty_input"><?= $errors['empty_input'] ?></span>
            <span class="error" id="no_user"><?= $errors['no_user'] ?></span>
            <span class="error" id="same_password"><?= $errors['same_password'] ?></span>
        </form>
    </div>

</body>

</html>