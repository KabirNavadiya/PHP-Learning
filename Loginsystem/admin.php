<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/view/login_view.inc.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/adminpage.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <h1>Hello Admin, Welcome to admin page</h1>


    <?php
    session_start();
    $isLoggedIn = isset($_SESSION['user_id']);
    // $username = $isLoggedIn ? htmlspecialchars($_SESSION["user_username"]) : null;
    echo '<button onclick = "window.location.href=\'includes/logout.inc.php\';">Logout</button>';
    ?>

    <form action="product.php" target="_blank">
        <button class="add">Add product</button>
    </form>
    <div class="containerc">
        <form id="editForm" class="editForm" action="#">
            <input type="text" class="input-field" id="eproductId" placeholder="Product Id" disabled>
            <input type="text" class="input-field" id="eproductName" placeholder="Product Name">
            <select id="eproductCategory">
                <option value="electronics">Electronics</option>
                <option value="fashion">Fashion</option>
                <option value="furniture">Furniture</option>
            </select>
            <input type="number" class="input-field" id="eprice" placeholder="Price">
            <input type="text" class="input-field" id="edescription" placeholder="Description">
            <input type="file" id="eproductImage" accept="image/*">
            <button class="edit-product" id="Update" type="submit" value="edit-btn">Update</button>
        </form>

        <form id="filter" action="#">
            <label>search:</label>
            <input type="text" id="filterInput" class="filter input-field" placeholder="Search" oninput="handleSearch()">
            <label>Sort by:</label>
            <select id="sortSelect" class="filter input-field">
                <option value="name">Product Name</option>
                <option value="price" selected>Price</option>
            </select>
            <button class="apply-filter" id="sortItem" type="submit">Apply</button>
        </form>

    </div>

    <h1>Product List</h1>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="productTable"></tbody>
    </table>

    <script src="Flipkart-CRUD/admin/script/displayproduct.js"></script>
</body>

</html>