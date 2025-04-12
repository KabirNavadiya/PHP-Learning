<?php
require_once 'dbh.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/view/addproduct_view.php';
require_once 'includes/model/addproduct_model.php';
require_once 'includes/model/addcategory_model.php';
require_once 'includes/view/addproduct_view.php';
require_once 'includes/admin_redirect.php';
$categories = getAllCategories($conn);
$errors = addProductErrors();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Management</title>
  <link rel="stylesheet" href="css/product.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>
  <noscript>Please Enable Javascript !</noscript>
  <a href="/admin" class="btn btn-primary">
    ← Back
  </a>
  <h1 style="display: flex; align-items: center; justify-content: center; margin: auto;">Add Product</h1>


  <div class="containerc">
    <form id="productForm" class="productForm" action="includes/addproduct" method="POST" enctype="multipart/form-data">
      <div class="inputs">
        <input type="text" class="input-field" id="productName" name="productName" placeholder="Product Name">
        <span class="error" id="empty_productname"><?= $errors['empty_productname'] ?></span>
      </div>
      <div class="inputs">
        <select id="productCategory" name="productCategory">

          <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
          <?php endforeach; ?>

        </select>
        <span class="error" id="empty_productcategory"><?= $errors['empty_productcategory'] ?></span>
      </div>
      <div class="inputs">
        <input type="number" class="input-field" id="price" name="productPrice" placeholder="Price">
        <span class="error" id="empty_productprice"><?= $errors['empty_productprice'] ?></span>
        <span class="error" id="invalid_price"><?= $errors['invalid_price'] ?></span>
      </div>
      <div class="inputs">
        <input type="text" class="input-field" id="description" name="productDescription" placeholder="Description">
        <span class="error" id="empty_productdescription"><?= $errors['empty_productdescription'] ?></span>
      </div>
      <div class="inputs">
        <input type="file" id="productImage" name="productImage" accept="image/*">
        <span class="error" id="empty_productimage"><?= $errors['empty_productimage'] ?></span>
        <span class="error" id="image_error"><?= $errors['image_error'] ?></span>
        <span class="error" id="large_file"><?= $errors['large_file'] ?></span>
      </div>
      <div class="inputs">
        <input type="number" class="input-field" id="discount" name="discount" placeholder="Discount (%)">
        <span class="error" id="invalid_discount"><?= $errors['invalid_discount'] ?></span>
        <span class="error" id="discount_range"><?= $errors['discount_range'] ?></span>
      </div>
      <button class="add-product" id="submitButton" type="submit" value="submit-btn">Add Product</button>
      <span class="error" id="product_exists"><?= $errors['product_exists'] ?></span>
    </form>
  </div>

  <div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="liveToast" class="toast <?= isset($_SESSION['product_success']) ? 'show' : ''; ?>" role="alert" aria-live="assertive" aria-atomic="true">
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