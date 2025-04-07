<?php
require_once 'dbh.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/view/addproduct_view.php';
require_once 'includes/model/addproduct_model.php';

$categories = getCategories($conn);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Management</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>
  <a href="admin.php" class="btn btn-primary">
    ← Back
  </a>
  <h1 style="display: flex; align-items: center; justify-content: center; margin: auto;">Add Product</h1>


  <div class="containerc">
    <form id="productForm" class="productForm" action="includes/addproduct.php" method="POST" enctype="multipart/form-data">
      <input type="text" class="input-field" id="productName" name="productName" placeholder="Product Name">
      <select id="productCategory" name="productCategory">

        <?php foreach ($categories as $category): ?>
          <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
        <?php endforeach; ?>

      </select>
      <input type="number" class="input-field" id="price" name="productPrice" placeholder="Price">
      <input type="text" class="input-field" id="description" name="productDescription" placeholder="Description">
      <input type="file" id="productImage" name="productImage" accept="image/*">
      <input type="number" class="input-field" id="discount" name="discount" placeholder="Discount (%)">
      <button class="add-product" id="submitButton" type="submit" value="submit-btn">Add Product</button>
    </form>

    <?php
    checkAddProductErrors();
    ?>
  </div>

  <!-- toast -->
  <div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="liveToast" class="toast <?php echo isset($_SESSION['product_success']) ? 'show' : ''; ?>" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto">Success</strong>
        <small>Just now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        <?php
        if (isset($_SESSION['product_success'])) {
          echo $_SESSION['product_success'];
          unset($_SESSION['product_success']);
        }
        ?>
      </div>
    </div>
  </div>
</body>

</html>