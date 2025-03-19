<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form handling</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="card">
        <h2><i class="fas fa-paw"></i> Tell Us About You</h2>
        <form action="/formhandling.php" method="post">
            <div class="form-group">
                <label for="firstname"><i class="fas fa-user"></i> First Name</label>
                <input id="firstname" type="text" name="firstname" placeholder="Firstname..." >
            </div>

            <div class="form-group">
                <label for="lastname"><i class="fas fa-user"></i> Last Name</label>
                <input id="lastname" type="text" name="lastname" placeholder="Lastname..." >
            </div>

            <div class="form-group">
                <label for="favouritepet"><i class="fas fa-dog"></i> Favourite Pet</label>
                <select name="favouritepet" id="favouritepet">
                    <option value="none">None</option>
                    <option value="dog">🐶 Dog</option>
                    <option value="cat">🐱 Cat</option>
                    <option value="bird">🐦 Bird</option>
                </select>
            </div>

            <button type="submit"><i class="fas fa-paper-plane"></i> Send</button>
        </form>
    </div>
</body>

</html>