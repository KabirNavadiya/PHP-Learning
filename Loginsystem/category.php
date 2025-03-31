<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/model/addcategory_model.php';
require_once 'includes/model/editcategory_model.php';


// $products = getProducts($conn);
$categories = getCategories($conn);

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoryId'])) {
    $categoryId = $_POST['categoryId'];
    $category = getCurrentCategory($conn, $categoryId);
    header('Content-Type: application/json');
    echo json_encode($category ?: ['error' => 'Category not found']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Datatable CSS-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

</head>

<body>
    <div class="container-fluid my-4 mx-1">
    <h1 style="display: flex; align-items: center; justify-content: center; margin: auto;">Add Category</h1>
    <a href="admin.php" class="btn btn-primary">
        ← Back
    </a>

    <div class="containerc " id="addcontainer">
        <form id="productForm" class="productForm" action="includes/addcategory.php" method="POST">
            <input type="text" class="input-field" id="categoryName" name="categoryName" placeholder="Category Name">
            <button class="Add-product" id="submitButton" type="submit" value="submit-btn">Add Category</button>
        </form>
    </div>

    <div id="editContainer" class="card p-4 mx-auto shadow-lg" style="max-width: 500px; display: none;">
        <h3 class="text-center">Edit Category</h3>
        <form id="editForm" action="includes/edit_category.php" method="POST">
            <input type="hidden" id="ecategoryid" name="categoryId">
            <div class="mb-3">
                <input type="text" class="form-control" id="ecategoryname" name="categoryName" placeholder="Category Name">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <button type="button" class="btn btn-secondary" onclick="hideCategoryForm()">Cancel</button>
        </form>
    </div>


        <h2 class="text-center mt-4">Category List</h2>
        <div class="table-responsive">
        <table id="categoryTable" class="table table-striped table-bordered text-center w-100">
            <thead class="table-dark">
                <tr>
                    <th>Category ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td><?= htmlspecialchars($category['id']); ?></td>
                        <td><?= htmlspecialchars($category['name']); ?></td>
                        <td>
                            <button class="btn btn-warning" onclick="editCategory(<?= htmlspecialchars($category['id']); ?>)"><i class="bi bi-pencil-fill"></i></button>
                            <button class="btn btn-danger " onclick="deleteCategory(<?= htmlspecialchars($category['id']); ?>)"><i class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        
        
        <!-- toast -->
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="liveToast" class="toast <?php echo isset($_SESSION['category_success']) ? 'show' : ''; ?>" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Success</strong>
                    <small>Just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?php
                if (isset($_SESSION['category_success'])) {
                    echo $_SESSION['category_success'];
                    unset($_SESSION['category_success']);
                }
                ?>
            </div>
        </div>
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

    <script>
        $(document).ready(function() {
            $('#categoryTable').DataTable({
                responsive: true,
                "processing": true,
                dom: '<"top"lf>rt<"bottom"ipB>',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                lengthMenu: [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                info: false,
                columnDefs: [{
                    orderable: false,
                    targets: [2]
                }]
            });

        });

        function hideCategoryForm() {
            document.getElementById('editContainer').style.display = "none";
            document.getElementById('addcontainer').style.display = "block";

        }

        function editCategory(categoryid) {
            document.getElementById('addcontainer').style.display = "none";
            fetch('category.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'categoryId=' + encodeURIComponent(categoryid)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    document.getElementById('ecategoryid').value = data.id;
                    document.getElementById('ecategoryname').value = data.name;
                    document.getElementById('editContainer').style.display = "block";
                })
                .catch(error => alert('Failed to fetch category. Please try again.'));
        }


        function deleteCategory(categoryid) {
            if (confirm("Are you sure you want to delete this product?")) {
                fetch('includes/delete_category.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'categoryId=' + encodeURIComponent(categoryid)
                    })
                    .then(response => window.location.reload())
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>


</body>

</html>