<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/view/update_view.inc.php';
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
        <form action="includes/update.inc.php" method="POST" class="login-form">
            <h1>update password</h1>
            <div class="inputs">
                <input type="text" id="username" name="username" placeholder="username" required>
            </div>
            <div class="inputs">
                <input type="password" id="new-password" name="new-password" placeholder="New password" required>
            </div>
            <div class="inputs">
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm password" required>
            </div>
            <button> Update</button>
        </form>

    <?php
    checkUpdateErrors();
    ?>
    </div>

</body>

</html>