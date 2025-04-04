<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/model/addproduct_model.php';
require_once 'includes/model/addtocart_model.php';

if (isset($_SESSION['user_id'])) {
  require_once 'includes/model/addtocart_model.php';
  $userCartProducts = getAllUserCartProducts($conn, $_SESSION['user_id']);
  $cartCount = count($userCartProducts);
} else {
  $cartCount = 0;
}

$products = getProducts($conn);
$categories = getCategories($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/home.css">

  <title>Flipkart</title>

  <style>
    .card-img-top {
      width: 100%;
      height: 200px !important;
      object-fit: contain;
    }

    .card-img:hover {
      transform: none !important;
    }

    .addto-cart-button {
      width: 60px;
      height: 30px;
      border-radius: 5px;
      border: 1px solid rgb(33, 89, 245);
      background-color: white;
      color: rgb(33, 89, 245);
      font-size: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease-in-out;
    }

    .addto-cart-button:hover {
      background-color: rgb(79, 122, 240);
      color: white;
    }

    .addto-cart {
      display: flex;
      justify-content: center;
      margin-bottom: 10px;
    }

    .cart {
      position: relative;
      /* Ensures absolute positioning inside */
      display: inline-block;
    }

    .cart-btn {
      position: relative;
      /* Makes sure the badge is positioned inside the button */
      padding: 10px 15px;
    }

    .badge {
      position: absolute;
      top: 0;
      right: 0;
      transform: translate(50%, -50%);
      background: #E91E63;
      color: white;
      font-size: 12px;
      font-weight: bold;
      padding: 5px 8px;
      border-radius: 50%;
      min-width: 20px;
      min-height: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .cards {
      position: relative;
      /* Ensures the label is positioned correctly */
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .exclusive-offer-label {
      position: absolute;
      top: 30px;
      left: -20px;
      background-color: red;
      color: white;
      padding: 5px 10px;
      font-size: 12px;
      font-weight: bold;
      border-radius: 5px;
      text-transform: uppercase;
      transform: rotate(-45deg);
      z-index: 10;
    }

    .discount {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: rgba(39, 94, 245, 0.86);
      color: white;
      padding: 5px 5px;
      font-size: 12px;
      font-weight: bold;
      border-radius: 5px;
      text-transform: uppercase;
      z-index: 10;
    }


    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
      animation: fadeIn 0.3s ease-in-out;
    }

    .modal-content {
      background: white;
      padding: 25px;
      border-radius: 12px;
      text-align: center;
      width: 350px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      animation: slideIn 0.3s ease-in-out;
    }

    .modal-buttons {
      display: flex;
      justify-content: space-between;
      gap: 10px;
    }

    .modal-buttons button,
    .modal-content button {
      flex: 1;
      padding: 12px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s ease-in-out;
    }

    .close-btn {
      background-color: rgb(255, 85, 85);
      color: white;
    }

    .close-btn:hover {
      background-color: rgb(220, 50, 50);
    }

    .checkout-btn {
      background-color: #007bff;
      color: white;
    }

    .checkout-btn:hover {
      background-color: #0056b3;
    }

    p {
      padding-left: 3px;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @keyframes slideIn {
      from {
        transform: translateY(-20px);
      }

      to {
        transform: translateY(0);
      }
    }
  </style>
</head>

<body>

  <!-- navbar -->
  <header>
    <nav class="navbar navbar-expand p-1 container">
      <div class="logo-search">
        <div class="logo">
          <a class="navbar-brand" href="#">
            <img
              src="https://static-assets-web.flixcart.com/batman-returns/batman-returns/p/images/fkheaderlogo_exploreplus-44005d.svg"
              alt="Bootstrap" class="flipkart-logo">
          </a>
        </div>
        <div class="search-container" id="search">
          <button class="search-icon" id="search">
            <svg class="search-icon" width="24" height="24" viewBox="0 0 24 24" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <title>Search Icon</title>
              <path
                d="M10.5 18C14.6421 18 18 14.6421 18 10.5C18 6.35786 14.6421 3 10.5 3C6.35786 3 3 6.35786 3 10.5C3 14.6421 6.35786 18 10.5 18Z"
                stroke="#717478" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
              <path d="M16 16L21 21" stroke="#717478" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
              </path>
            </svg>
          </button>
          <input type="search" id="search-bar" placeholder="Search for Products, Brands and More" />
        </div>
      </div>
      <div class="login-cart">

        <?php
        session_start();
        $isLoggedIn = isset($_SESSION['user_id']);
        $username = $isLoggedIn ? htmlspecialchars($_SESSION["user_username"]) : null;

        echo '<div class="dropdown">
        <button class="btn btn-light login-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"';

        if (!$isLoggedIn) {
          echo ' onclick="window.location.href=\'login.php\';"';
        }

        echo '>
        <svg class="person-logo" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
          class="bi bi-person-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
          <path fill-rule="evenodd"
            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
        </svg>
        <span class="dn">' . ($isLoggedIn ? $username : "Login") . '</span>
      </button>

      <ul class="dropdown-menu">';

        if (!$isLoggedIn) {
          echo '<li class="dropdown-item">New Customer? <span><a href="signup.php" class="sign-up">Sign-up</a></span></li>
          <li><hr class="dropdown-divider"></li>';
        } else {
          echo '<li><a class="dropdown-item" href="#"><i class="bi bi-person-circle nav-i"></i> My Profile</a></li>
          <li><a class="dropdown-item" href="orders.php"><i class="bi bi-box-seam nav-i"></i> Orders</a></li>
          <li><a class="dropdown-item" href="#"><i class="bi bi-heart nav-i"></i> Wishlist</a></li>
          <li><a class="dropdown-item" href="#"><i class="bi bi-wallet2 nav-i"></i> Gift Card</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-danger" href="includes/logout.inc.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>';
        }

        echo '</ul></div>';
        ?>


        <div class="cart">
          <button class="btn btn-light cart-btn highlight" type="button" onclick="window.location.href='cart.php';">
            <svg class="cart-logo" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
              class="bi bi-cart" viewBox="0 0 16 16">
              <path
                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
            </svg>
            <span class="dn">Cart</span>
            <span class="badge badge-primary" id="dot" style="display: <?= ($cartCount > 0) ? 'block' : 'none'; ?>;">
              <?= ($cartCount > 0) ? $cartCount : ''; ?>
            </span>
          </button>
        </div>


        <div class="seller">
          <button class="btn btn-light seller-btn" type="button">
            <svg class="seller-logo" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
              class="bi bi-shop-window" viewBox="0 0 16 16">
              <path
                d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h12V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5m2 .5a.5.5 0 0 1 .5.5V13h8V9.5a.5.5 0 0 1 1 0V13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a.5.5 0 0 1 .5-.5" />
            </svg>
            <span class="dn"> Become a Seller</span>
          </button>
        </div>

        <div class="dropstart">
          <button type="button" class="btn btn-light" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
              class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
              <path
                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
            </svg>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#"><i class="bi bi-bell nav-i"></i>Notification Preferences</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-headset nav-i"></i>24x7 Customer care</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-badge-ad nav-i"></i>Advertise</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-download nav-i"></i>Downlaod App</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>


  <!-- shoping cards -->
  <div class="category-container  my-2">
    <div class="container-fluid category-top">
      <div class="d-flex  category-images">
        <div class="card-c">
          <img src="images/grocery.webp" class="cat-img"
            alt="grocery">
          <div class="">
            <p class="card-texts"><small class="text-body-dark category-text">Grocery</small></p>
          </div>
        </div>

        <div class="card-c">
          <img src="images/mobiles.webp" class="cat-img"
            alt="mobiles">
          <div class="">
            <p class="card-texts"><small class="text-body-dark category-text">Mobiles</small></p>
          </div>
        </div>

        <div class="card-c">
          <img src="images/fashion.png" class="cat-img"
            alt="fashion">
          <div class="">
            <p class="card-texts"><small class="text-body-dark dropdown-toggle category-text">Fashion </small></p>
          </div>
        </div>

        <div class="card-c">
          <img src="images/electronics.png" class="cat-img"
            alt="electronics">
          <div class="">
            <p class="card-texts"><small class="text-body-dark dropdown-toggle category-text">Electronics</small></p>
          </div>
        </div>

        <div class="card-c">
          <img src="images/furniture.jpg" class="cat-img"
            alt="furniture">
          <div class="">
            <p class="card-texts"><small class="text-body-dark dropdown-toggle category-text">Home & Furniture</small>
            </p>
          </div>
        </div>

        <div class="card-c">
          <img src="images/apliances.webp" class="cat-img"
            alt="appliances">
          <div class="">
            <p class="card-texts"><small class="text-body-dark category-text">Appliances</small></p>
          </div>
        </div>


        <div class="card-c">
          <img src="images/flightbooking.webp" class="cat-img"
            alt="flightbooking">
          <div class="">
            <p class="card-texts"><small class="text-body-dark category-text">Flight Bookings</small></p>
          </div>
        </div>

        <div class="card-c">
          <img src="images/beautytoys.png" class="cat-img"
            alt="beautytoys">
          <div class="">
            <p class="card-texts"><small class="text-body-dark dropdown-toggle category-text">Beauty, Toys &
                More</small></p>
          </div>
        </div>

        <div class="card-c">
          <img src="images/twowheeler.png" class="cat-img"
            alt="twowheeler">
          <div class="">
            <p class="card-texts"><small class="text-body-dark dropdown-toggle category-text">Two Wheeler</small></p>
          </div>
        </div>


      </div>
    </div>
  </div>


  <!-- carousel -->
  <div class="carousel-container my-2 pb-4">
    <div class="advertisement">
      <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="1000">
            <img src="images/carousel1.webp"
              class="d-block w-100" alt="carousel1">
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="images/carousel2.webp"
              class="d-block w-100" alt="carousel2">
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="images/carousel3.webp"
              class="d-block w-100" alt="carousel3">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>


  <?php
  foreach ($categories as $category) {
    $filteredProducts = array_filter($products, function ($product) use ($category) {
      return $product['category_name'] == $category['name'];
    });

    echo '<div class="boe-heading bg-light mt-4 px-3 py-2">
          <div class="row mt-3">
              <h4>' . $category['name'] . '</h4>
          </div>
        </div>
        <div class="boe bg-light ">
          <div class="initial-items-list ">
            <div class="row w-100">
              <div class="col-12 ">
                <div id="carouselExample' . $category['id'] . '" class="carousel slide">
                  <div class="carousel-inner carousle-overflow">';

    if (!empty($filteredProducts)) {
      $first = true;
      foreach (array_chunk($filteredProducts, 6) as $productSet) {
        echo '<div class="carousel-item ' . ($first ? 'active' : '') . '">
                  <div class="cards-wrapper">';
        foreach ($productSet as $product) {
          $discountPrice = $product['price'] - ($product['price'] * $product['discount']) / 100;
          echo '<div class="cards">';

          if ($product['discount'] >= 25) {
            echo '   <!-- Exclusive Offer Label -->
            <span class="exclusive-offer-label">Exclusive Offer</span>';
          }

          if ($product['discount']) {
            echo ' 
            <span class="discount">-' . $product['discount'] . '%</span>';
          }
          echo '<img src="' ."includes/uploads/". $product['image'] . '" class="card-img-top card-img" alt="...">
                      <div class="card-body">
                          <p class="card-title text-center">' . $product['product_name'] . '</p>


                          ';
          if ($product['discount']) {
            echo '<p class="card-text text-center">
                    <span style="color: gray; font-size: 14px;">&#8377;<del>' . $product['price'] . '</del></span> 
                    <strong>&#8377;' . $discountPrice . '</strong>
                  </p>';
          } else {
            echo '<p class="card-text text-center">&#8377;' . $product['price'] . '</p>';
          }

          echo '</div>
                      <div class="addto-cart">
                       <button class="addto-cart-button" onclick="addToCart(' . $product['id'] . ')">Add</button>
                      </div>
                  </div>';
        }

        echo '  </div>
                </div>';
        $first = false;
      }
    } else {
      echo '<p>No products available in this category.</p>';
    }
    echo '    </div>
                <button class="carousel-control-prev bg-dark carousel-btns" type="button" data-bs-target="#carouselExample' . $category['id'] . '" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next bg-dark carousel-btns" type="button" data-bs-target="#carouselExample' . $category['id'] . '" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
          </div>
        </div>';
  }
  ?>

  <div id="loginModal" class="modal">
    <div class="modal-content">
      <h4>Want to buy something?</h4>
      <p>You need to Sign In first!</p>
      <button onclick="RedirectToLogin()">Login</button>
      <button class="close-btn" onclick="closeModal('loginModal')">Close</button>
    </div>
  </div>

  <div id="AddedToCartModal" class="modal">
    <div class="modal-content">
      <h4>Your item has been added to cart 😊</h4>
      <div class="modal-buttons">
        <button class="close-btn" onclick="closeModal('AddedToCartModal')">OK</button>
        <button class="checkout-btn" onclick="RedirectTocart()">Proceed to Checkout →</button>
      </div>
    </div>
  </div>

  <footer class="container-fluid text-center text-lg-start bg-dark text-white mt-4">
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
      <div class="me-5 d-none d-lg-block">
        <span>Follow us on</span>
      </div>
      <div class="footer-social">
        <i class="bi bi-facebook footer-i"></i>
        <i class="bi bi-twitter-x footer-i"></i>
        <i class="bi bi-instagram footer-i"></i>
        <i class="bi bi-linkedin footer-i"></i>
      </div>
    </section>

    <section>
      <div class="container text-center text-md-start mt-5">
        <div class="row mt-3">
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4">About</h6>
            <p><a href="#" class="text-reset">Contact Us</a></p>
            <p><a href="#" class="text-reset">About Us</a></p>
            <p><a href="#" class="text-reset">Careers</a></p>
            <p><a href="#" class="text-reset">Flipkart Stories</a></p>
          </div>

          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4">Help</h6>
            <p><a href="#" class="text-reset">Payments</a></p>
            <p><a href="#" class="text-reset">Shipping</a></p>
            <p><a href="#" class="text-reset">Cancellation & Returns</a></p>
            <p><a href="#" class="text-reset">FAQ</a></p>
          </div>

          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4">Consumer Policy</h6>
            <p><a href="#" class="text-reset">Return Policy</a></p>
            <p><a href="#" class="text-reset">Terms of Use</a></p>
            <p><a href="#" class="text-reset">Security</a></p>
            <p><a href="#" class="text-reset">Privacy</a></p>
          </div>

          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <h6 class="text-uppercase fw-bold mb-4">Registered Office Address</h6>
            <p>Flipkart Internet Private Limited</p>
            <p>Buildings Alyssa, Begonia & Clove Embassy Tech Village</p>
            <p>Outer Ring Road, Devarabeesanahalli Village, Bengaluru, 560103, Karnataka, India</p>
          </div>
        </div>
      </div>
    </section>

    <hr class="bg-light">
    <div class="text-center p-3 copy-right">
      &copy; 2025 Flipkart. All Rights Reserved.
    </div>
  </footer>


  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    let isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    let cartCount = <?= json_encode($cartCount); ?>;
  </script>
  <script src="js/index.js"></script>
</body>

</html>