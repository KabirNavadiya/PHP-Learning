<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form handling</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="card">
        <h2> Tell Us About You</h2>
        <form action="formhandling/formhandler.php" method="post">
            <div class="form-group">
                <label for="firstname"> First Name</label>
                <input id="firstname" type="text" name="firstname" placeholder="Firstname...">
            </div>

            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input id="lastname" type="text" name="lastname" placeholder="Lastname...">
            </div>

            <div class="form-group">
                <label for="favouritepet">Favourite Pet</label>
                <select name="favouritepet" id="favouritepet">
                    <option value="none">None</option>
                    <option value="dog">🐶 Dog</option>
                    <option value="cat">🐱 Cat</option>
                    <option value="bird">🐦 Bird</option>
                </select>
            </div>

            <button type="submit" name = 'submit'> Send</button>
        </form>
    </div>
</body>

</html>