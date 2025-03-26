<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/model/addproduct_model.php';
require_once 'includes/model/editproduct_model.php';

$products = getProducts($conn);

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

    <!-- jQuery Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

</head>

<body>
    <div class="container-fluid my-4 mx-1">
        <h1 class="text-center">Admin Dashboard</h1>

        <!-- Logout Button -->
        <div class="text-end">
            <button class="btn btn-danger" onclick="window.location.href='includes/logout.inc.php';">Logout</button>
        </div>

        <!-- Add Product Button -->
        <div class="text-center my-3">
            <form action="product.php">
                <button class="btn btn-primary">Add Product</button>
            </form>
        </div>

        <!-- Edit Product Form (Initially Hidden) -->
        <div id="editContainer" class="card p-4 mx-auto shadow-lg" style="max-width: 500px; display: none;">
            <h3 class="text-center">Edit Product</h3>
            <form id="editForm" action="includes/edit_product.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="eproductId" name="productId">
                <div class="mb-3">
                    <input type="text" class="form-control" id="eproductName" name="productName" placeholder="Product Name">
                </div>
                <div class="mb-3">
                    <select id="eproductCategory" name="productCategory" class="form-select">
                        <option value="1">Electronics</option>
                        <option value="2">Fashion</option>
                        <option value="3">Furniture</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" id="eprice" name="productPrice" placeholder="Price">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" id="edescription" placeholder="Description" name="productDescription"></textarea>
                </div>
                <div class="mb-3">
                    <label>Current Image:</label><br>
                    <img id="eproductImagePreview" src="" alt="Product Image" class="img-thumbnail" style="width: 100px;">
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" id="eproductImage" name="productImage" accept="image/*">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" onclick="hideEditForm()">Cancel</button>
                </div>
            </form>

        </div>


        <div class="container mt-4">
            <div class="card p-4 shadow-sm">
                <form id="filter" action="#" class="row g-3">
                    <div class="col-md-6">
                        <label for="filterInput" class="form-label">🔍 Search:</label>
                        <input type="text" id="filterInput" class="form-control" placeholder="Type to search...">
                    </div>

                    <div class="col-md-4">
                        <label for="sortSelect" class="form-label">📌 Sort by:</label>
                        <select id="sortSelect" class="form-select">
                            <option value="name">Product Name</option>
                            <option value="price" selected>Price</option>
                        </select>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-primary w-100" id="applyFilter" type="submit">Apply</button>
                    </div>
                </form>
            </div>
        </div>





        <!-- Product List -->
        <h2 class="text-center mt-4">Product List</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center  w-100" id="productTable">
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
                            <td><img src="<?= htmlspecialchars($product['image']); ?>" width="50" height="50" class="img-thumbnail"></td>
                            <td>
                                <button class="btn btn-warning" onclick="editProduct(<?= htmlspecialchars($product['id']); ?>)">Edit</button>
                                <button class="btn btn-danger " onclick="deleteProduct(<?= htmlspecialchars($product['id']); ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>



    </div>

    <!-- toast -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast <?php echo isset($_SESSION['edit_success']) || isset($_SESSION['delete_success']) ? 'show' : ''; ?>" role="alert" aria-live="assertive" aria-atomic="true">
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

        <script>
            function hideEditForm() {
                document.getElementById('editContainer').style.display = "none";
            }

            function editProduct(productId) {
                fetch('admin.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'productId=' + encodeURIComponent(productId)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }

                        document.getElementById('eproductId').value = data.id;
                        document.getElementById('eproductName').value = data.product_name;
                        document.getElementById('eproductCategory').value = data.category_id;
                        document.getElementById('eprice').value = data.price;
                        document.getElementById('edescription').value = data.description;
                        document.getElementById('eproductImagePreview').src = data.image;

                        document.getElementById('editContainer').style.display = "block";
                    })
                    .catch(error => console.error('Error fetching product:', error));
            }

            function deleteProduct(productId) {
                if (confirm("Are you sure you want to delete this product?")) {
                    fetch('includes/delete_product.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'productId=' + encodeURIComponent(productId)
                        })
                        .then(response => window.location.reload()) // Refresh page after deletion
                        .catch(error => console.error('Error:', error));
                }
            }
        </script>

</body>

</html>