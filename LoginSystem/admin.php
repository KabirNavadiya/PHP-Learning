<?php

require_once 'dbh.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/model/addproduct_model.php';
require_once 'includes/model/addcategory_model.php';
require_once 'includes/model/editproduct_model.php';
require_once 'includes/view/addproduct_view.php';
require_once 'includes/view/editproduct_view.php';
require_once 'includes/admin_redirect.php';

$products = getAllProducts($conn);
$categories = getAllCategories($conn);
$errors = addProductErrors();
$editerrors =  editProductErrors();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $product = getCurrentProduct($conn, $productId);

    header('Content-Type: application/json');
    echo json_encode($product ?: ['error' => 'Product not found']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/adminpage.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Datatable CSS-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

</head>

<body>
    <a href="/" class="btn btn-primary">
        ← Back
    </a>
    <div class="container-fluid my-4 mx-1">
        <h1 class="text-center">Admin Dashboard</h1>

        <div class="text-center my-3 add-buttons">
            <button class="btn btn-primary mx-1" onclick="window.location.href = '/product'">Add Product</button>
            <button class="btn btn-primary mx-1" onclick="window.location.href = '/category'">Add Category</button>
        </div>

        <div id="editContainer" class="card p-4 mx-auto shadow-lg" style="max-width: 500px;">
            <h3 class="text-center">Edit Product</h3>
            <form id="editForm" action="includes/edit_product" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="eproductId" name="productId">
                <div class="mb-3">
                    <input type="text" class="form-control" id="eproductName" name="productName" placeholder="Product Name">
                </div>
                <div class="mb-3">
                    <select id="eproductCategory" name="productCategory" class="form-select">
                        <option value="" selected disabled>Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" id="eprice" name="productPrice" placeholder="Price">
                    <span class="error" id="invalid_price"><?= $errors['invalid_price'] ?></span>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" id="edescription" placeholder="Description" name="productDescription"></textarea>
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" id="eproductImage" name="productImage" accept="image/*">
                    <span class="error" id="large_file"><?= $editerrors['large_file'] ?></span>
                    <span class="error" id="image_error"><?= $editerrors['image_error'] ?></span>
                </div>
                <div class="text-center">
                    <span class="error" id="empty_productid"><?= $editerrors['empty_productid'] ?></span><br>
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" onclick="hideEditForm()">Clear</button>
                </div>
            </form>
        </div>

        <h2 class="text-center mt-4">Product List</h2>
        <div class="table-responsive">
            <table id="productTable" class="table table-striped table-bordered text-center  w-100">
                <thead class="table-dark">
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
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?= htmlspecialchars($product['id']); ?></td>
                            <td><?= htmlspecialchars($product['product_name']); ?></td>
                            <td><?= htmlspecialchars($product['category_name']); ?></td>
                            <td><?= htmlspecialchars($product['price']); ?></td>
                            <td><?= htmlspecialchars($product['description']); ?></td>
                            <td><img src="<?= '/includes/uploads/' . $product['image']; ?>" width="50" height="50" class="img-thumbnail"></td>
                            <td>
                                <button class="btn btn-warning" onclick="editProduct(<?= htmlspecialchars($product['id']); ?>)"><i class="bi bi-pencil-fill"></i></button>
                                <button class="btn btn-danger " onclick="deleteProduct(<?= htmlspecialchars($product['id']); ?>)"><i class="bi bi-trash-fill"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- toast -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast <?= isset($_SESSION['edit_success']) || isset($_SESSION['delete_success']) ? 'show' : ''; ?>" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Success</strong>
                <small>Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?php
                if (isset($_SESSION['edit_success'])) {
                    echo $_SESSION['edit_success'];
                    unset($_SESSION['edit_success']);
                }
                ?>
            </div>
        </div>

        <!-- Datatables Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

        <script src="js/product.js"></script>


</body>

</html>