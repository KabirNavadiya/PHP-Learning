<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Signup</h2>
        <form action="includes/formhandler.inc.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Signup</button>
        </form>
        <a href="update.php">update account.</a>
        <a href="delete.php">delete acc.</a  ><br><br>

        <form class="searchform" action="search.php" method="post">
            <label for="search">Search for user : </label><br>
            <input type="text" name="usersearch" id="search" placeholder="search for user :">
            <button>Search</button>
        </form>
    </div>
</body>
</html>