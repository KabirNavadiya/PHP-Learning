<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/view/login_view.inc.php';
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
  <link rel="stylesheet" href="/css/home.css">

  <title>Flipkart</title>
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
          <li><a class="dropdown-item" href="#"><i class="bi bi-box-seam nav-i"></i> Orders</a></li>
          <li><a class="dropdown-item" href="#"><i class="bi bi-heart nav-i"></i> Wishlist</a></li>
          <li><a class="dropdown-item" href="#"><i class="bi bi-wallet2 nav-i"></i> Gift Card</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-danger" href="includes/logout.inc.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>';
        }

        echo '</ul></div>';
        ?>










        <div class="cart">
          <button class="btn btn-light cart-btn" type="button">
            <svg class="cart-logo" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
              class="bi bi-cart" viewBox="0 0 16 16">
              <path
                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
            </svg>
            <span class="dn">Cart</span>
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
        <!-- <span><a href="admin.php" target="_blank">Admin</a></span> -->
      </div>
    </nav>

  </header>


  <!-- shoping cards -->
  <div class="category-container  my-2">
    <div class="container-fluid category-top">
      <div class="d-flex  category-images">
        <div class="card-c">
          <img src="https://rukminim2.flixcart.com/flap/64/64/image/29327f40e9c4d26b.png?q=100" class="cat-img"
            alt="...">
          <div class="">
            <p class="card-texts"><small class="text-body-dark category-text">Grocery</small></p>
          </div>
        </div>

        <div class="card-c">
          <img src="https://rukminim2.flixcart.com/flap/64/64/image/22fddf3c7da4c4f4.png?q=100" class="cat-img"
            alt="...">
          <div class="">
            <p class="card-texts"><small class="text-body-dark category-text">Mobiles</small></p>
          </div>
        </div>

        <div class="card-c">
          <img src="https://rukminim2.flixcart.com/fk-p-flap/64/64/image/0d75b34f7d8fbcb3.png?q=100" class="cat-img"
            alt="...">
          <div class="">
            <p class="card-texts"><small class="text-body-dark dropdown-toggle category-text">Fashion </small></p>
          </div>
        </div>

        <div class="card-c">
          <img src="https://rukminim2.flixcart.com/flap/64/64/image/69c6589653afdb9a.png?q=100" class="cat-img"
            alt="...">
          <div class="">
            <p class="card-texts"><small class="text-body-dark dropdown-toggle category-text">Electronics</small></p>
          </div>
        </div>

        <div class="card-c">
          <img src="https://rukminim2.flixcart.com/flap/64/64/image/ab7e2b022a4587dd.jpg?q=100" class="cat-img"
            alt="...">
          <div class="">
            <p class="card-texts"><small class="text-body-dark dropdown-toggle category-text">Home & Furniture</small>
            </p>
          </div>
        </div>

        <div class="card-c">
          <img src="https://rukminim2.flixcart.com/fk-p-flap/64/64/image/0139228b2f7eb413.jpg?q=100" class="cat-img"
            alt="...">
          <div class="">
            <p class="card-texts"><small class="text-body-dark category-text">Appliances</small></p>
          </div>
        </div>


        <div class="card-c">
          <img src="https://rukminim2.flixcart.com/flap/64/64/image/71050627a56b4693.png?q=100" class="cat-img"
            alt="...">
          <div class="">
            <p class="card-texts"><small class="text-body-dark category-text">Flight Bookings</small></p>
          </div>
        </div>

        <div class="card-c">
          <img src="https://rukminim2.flixcart.com/flap/64/64/image/dff3f7adcf3a90c6.png?q=100" class="cat-img"
            alt="...">
          <div class="">
            <p class="card-texts"><small class="text-body-dark dropdown-toggle category-text">Beauty, Toys &
                More</small></p>
          </div>
        </div>

        <div class="card-c">
          <img src="https://rukminim2.flixcart.com/fk-p-flap/64/64/image/05d708653beff580.png?q=100" class="cat-img"
            alt="...">
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
            <img src="https://rukminim2.flixcart.com/fk-p-flap/1010/170/image/ae33e00a9d467576.jpg?q=20"
              class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="https://rukminim2.flixcart.com/fk-p-flap/1010/170/image/9600dc6f546d1164.jpeg?q=20"
              class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="https://rukminim2.flixcart.com/fk-p-flap/1010/170/image/d9290fb51138d286.png?q=20"
              class="d-block w-100" alt="...">
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


  <!-- best of electronics -->
  <div class="boe-heading bg-light mt-3 p-2">
    <div class="row mt-2 ms-2">
      <h4>Best of Electronics</h4>
    </div>
  </div>

  <div class="boe bg-light">
    <div class=" initial-items-list" id="boe">
      <div class="row w-100">
        <div class="col-10" id="boe">
          <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner carousle-overflow">
              <div class="carousel-item active">
                <div class="cards-wrapper">
                  <div class="cards">
                    <img
                      src="images/GT True wireless.jpg"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Best Wireless Headphone</p>
                      <h5 class="card-text text-center">Grab Now*</h5>
                    </div>
                  </div>

                  <div class="cards">
                    <img
                      src="images/vivo-mobile-phone.jpg"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Vivo Y100</p>
                      <h5 class="card-text text-center">$199</h5>
                    </div>
                  </div>


                  <div class="cards">
                    <img
                      src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcTYY-RJLZS4op2B806yVKjC_-CypRhDC0NNps80B0a1UaQQTVHJ0bw00biYFv7zA_b93wFqPg6x39Eg6vPKODBoqnOG8y6XGQP17QqIMZBRGsQiFR3mtf00sg&usqp=CAE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body ">
                      <p class="card-title text-center">Printers</p>
                      <h5 class="card-text text-center">$2066</h5>
                    </div>
                  </div>
                  <div class="cards">
                    <img
                      src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQPmJhne-b2fGt-g6t9qCGNDe78_WmLw_5NgcqkSXTHZ6QM7dl06F9p7KuDuHBcURYmI6S6WBXOwptTfjslSSkwtdKFm08S-0Y0OIBbs8k-yNg_EIofyGtH&usqp=CAE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Watches</p>
                      <h5 class="card-text text-center">$234<h5>
                    </div>
                  </div>

                  <div class="cards">
                    <img
                      src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcSb-ILaW9XaBYD_pH3a0JhH6jRmAkWKQQ-lNxEpeNHyCpg7yCTBSo8JaM2xnVINuQlSBxZrLObNaM39fYEjoIJ6O7YM2zcMeqv7HvwE7osvtOwn2m65N-_QGQ&usqp=CAE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Monitor</p>
                      <h5 class="card-text text-center">$5436</h5>
                    </div>
                  </div>

                </div>
              </div>
              <div class="carousel-item">
                <div class="cards-wrapper">
                  <div class="cards">
                    <img
                      src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQPmJhne-b2fGt-g6t9qCGNDe78_WmLw_5NgcqkSXTHZ6QM7dl06F9p7KuDuHBcURYmI6S6WBXOwptTfjslSSkwtdKFm08S-0Y0OIBbs8k-yNg_EIofyGtH&usqp=CAE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Watches</p>
                      <h5 class="card-text text-center">$234<h5>
                    </div>
                  </div>

                  <div class="cards">
                    <img
                      src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQPmJhne-b2fGt-g6t9qCGNDe78_WmLw_5NgcqkSXTHZ6QM7dl06F9p7KuDuHBcURYmI6S6WBXOwptTfjslSSkwtdKFm08S-0Y0OIBbs8k-yNg_EIofyGtH&usqp=CAE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Watches</p>
                      <h5 class="card-text text-center">$234<h5>
                    </div>
                  </div>


                  <div class="cards">
                    <img
                      src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcSb-ILaW9XaBYD_pH3a0JhH6jRmAkWKQQ-lNxEpeNHyCpg7yCTBSo8JaM2xnVINuQlSBxZrLObNaM39fYEjoIJ6O7YM2zcMeqv7HvwE7osvtOwn2m65N-_QGQ&usqp=CAE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Monitor</p>
                      <h5 class="card-text text-center">$5436</h5>
                    </div>
                  </div>
                  <div class="cards">
                    <img
                      src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcTt-oorsWvG_ABWCWtvhWBet7nIo6e7ANlJ44HlFzB25rqxNSZYCZYtiuGMWpBcxJwW9suYxHfsi59z-Prg40rg3MwijdD9Dw&usqp=CAE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Camera</p>
                      <h5 class="card-text text-center">$387</h5>
                    </div>
                  </div>


                  <div class="cards">
                    <img
                      src="https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcTucIBakKbROvB0EY8q1ilYOOhF9zBJLlYHxxK-gjqAY52jcl_ByztL8riZPmEZZsWLr_meukCxUF0WNZpVhphX5mMCIxYu4WULl1ieOVwDYvKYKEIWjXd7&usqp=CAEE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Projector</p>
                      <h5 class="card-text text-center">$980</h5>
                    </div>
                  </div>

                </div>
              </div>


            </div>
            <button class="carousel-control-prev bg-dark carousel-btns" type="button" data-bs-target="#carouselExample"
              data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next bg-dark carousel-btns" type="button" data-bs-target="#carouselExample"
              data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>

        <div class="col-2" id="ad">
          <div>
            <img class="offer" src="https://rukminim1.flixcart.com/fk-p-flap/260/810/image/d5d599c240c9b2ea.jpeg?q=20"
              alt="">
          </div>
        </div>
      </div>
    </div>
  </div>


  <!--Recently visited-->
  <div class="boe-heading bg-light mt-3 p-2">
    <div class="row mt-2 ms-2">
      <h4>Recently Visited items</h4>
    </div>
  </div>
  <div class="boe bg-light">
    <div class=" initial-items-list">
      <div class="row w-100">
        <div class="col-12">
          <div id="carouselExample1" class="carousel slide">
            <div class="carousel-inner carousle-overflow">
              <div class="carousel-item active">
                <div class="cards-wrapper">
                  <div class="cards">
                    <img
                      src="images/ps5 .jpg"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">PS5</p>
                      <h5 class="card-text text-center">$699</h5>
                    </div>
                  </div>
                  <div class="cards">
                    <img
                      src="images/tshirt.webp"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Tshirt</p>
                      <h5 class="card-text text-center">$20</h5>
                    </div>
                  </div>
                  <div class="cards">
                    <img
                      src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQPmJhne-b2fGt-g6t9qCGNDe78_WmLw_5NgcqkSXTHZ6QM7dl06F9p7KuDuHBcURYmI6S6WBXOwptTfjslSSkwtdKFm08S-0Y0OIBbs8k-yNg_EIofyGtH&usqp=CAE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Watches</p>
                      <h5 class="card-text text-center">$234<h5>
                    </div>
                  </div>

                  <div class="cards">
                    <img
                      src="images/Sony tv.jpg"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Sony TV</p>
                      <h5 class="card-text text-center">$499</h5>
                    </div>
                  </div>
                  <div class="cards">
                    <img
                      src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQPmJhne-b2fGt-g6t9qCGNDe78_WmLw_5NgcqkSXTHZ6QM7dl06F9p7KuDuHBcURYmI6S6WBXOwptTfjslSSkwtdKFm08S-0Y0OIBbs8k-yNg_EIofyGtH&usqp=CAE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Watches</p>
                      <h5 class="card-text text-center">$234<h5>
                    </div>
                  </div>

                  <div class="cards">
                    <img
                      src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQPmJhne-b2fGt-g6t9qCGNDe78_WmLw_5NgcqkSXTHZ6QM7dl06F9p7KuDuHBcURYmI6S6WBXOwptTfjslSSkwtdKFm08S-0Y0OIBbs8k-yNg_EIofyGtH&usqp=CAE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Watches</p>
                      <h5 class="card-text text-center">$234<h5>
                    </div>
                  </div>

                </div>
              </div>
              <div class="carousel-item">
                <div class="cards-wrapper">

                  <div class="cards">
                    <img
                      src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQPmJhne-b2fGt-g6t9qCGNDe78_WmLw_5NgcqkSXTHZ6QM7dl06F9p7KuDuHBcURYmI6S6WBXOwptTfjslSSkwtdKFm08S-0Y0OIBbs8k-yNg_EIofyGtH&usqp=CAE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Watches</p>
                      <h5 class="card-text text-center">$234<h5>
                    </div>
                  </div>

                  <div class="cards">
                    <img
                      src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcSb-ILaW9XaBYD_pH3a0JhH6jRmAkWKQQ-lNxEpeNHyCpg7yCTBSo8JaM2xnVINuQlSBxZrLObNaM39fYEjoIJ6O7YM2zcMeqv7HvwE7osvtOwn2m65N-_QGQ&usqp=CAE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Monitor</p>
                      <h5 class="card-text text-center">$5436</h5>
                    </div>
                  </div>
                  <div class="cards">
                    <img
                      src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcTt-oorsWvG_ABWCWtvhWBet7nIo6e7ANlJ44HlFzB25rqxNSZYCZYtiuGMWpBcxJwW9suYxHfsi59z-Prg40rg3MwijdD9Dw&usqp=CAE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Camera</p>
                      <h5 class="card-text text-center">$387</h5>
                    </div>
                  </div>

                  <div class="cards">
                    <img
                      src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQPmJhne-b2fGt-g6t9qCGNDe78_WmLw_5NgcqkSXTHZ6QM7dl06F9p7KuDuHBcURYmI6S6WBXOwptTfjslSSkwtdKFm08S-0Y0OIBbs8k-yNg_EIofyGtH&usqp=CAE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Watches</p>
                      <h5 class="card-text text-center">$234<h5>
                    </div>
                  </div>

                  <div class="cards">
                    <img
                      src="https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcTucIBakKbROvB0EY8q1ilYOOhF9zBJLlYHxxK-gjqAY52jcl_ByztL8riZPmEZZsWLr_meukCxUF0WNZpVhphX5mMCIxYu4WULl1ieOVwDYvKYKEIWjXd7&usqp=CAEE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Projector</p>
                      <h5 class="card-text text-center">$980</h5>
                    </div>
                  </div>

                  <div class="cards">
                    <img
                      src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcTYY-RJLZS4op2B806yVKjC_-CypRhDC0NNps80B0a1UaQQTVHJ0bw00biYFv7zA_b93wFqPg6x39Eg6vPKODBoqnOG8y6XGQP17QqIMZBRGsQiFR3mtf00sg&usqp=CAE"
                      class="card-img-top card-img" alt="...">
                    <div class="card-body">
                      <p class="card-title text-center">Printers
                      <h5 class="card-text text-center">From $2066</h5>
                    </div>
                  </div>




                </div>
              </div>

            </div>
            <button class="carousel-control-prev bg-dark carousel-btns" type="button" data-bs-target="#carouselExample1"
              data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next bg-dark carousel-btns" type="button" data-bs-target="#carouselExample1"
              data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- new products -->
  <!-- <div class="boe-heading bg-light mt-3 p-2">
    <div class="row mt-2 ms-2">
      <h4>New Products</h4>
    </div>
  </div> -->

  <div class="boe bg-light" id="new-product-container">

  </div>
  <div class="boe bg-light" id="fashion-container">

  </div>
  <div class="boe bg-light" id="furniture-container">

  </div>



  <footer class="container-fluid text-center text-lg-start bg-dark text-white mt-4">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
      <!-- Left -->
      <div class="me-5 d-none d-lg-block">
        <span>Get connected with us on social networks:</span>
      </div>
      <!-- Left -->

      <!-- Right -->
      <div class="footer-social">
        <i class="bi bi-facebook footer-i"></i>
        <i class="bi bi-twitter-x footer-i"></i>
        <i class="bi bi-google footer-i"></i>
        <i class="bi bi-instagram footer-i"></i>
        <i class="bi bi-linkedin footer-i"></i>
        <i class="bi bi-github footer-i"></i>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              <i class="bi bi-gem footer-i"></i>Company name
            </h6>
            <p>
              Here you can use rows and columns to organize your footer content. Lorem ipsum
              dolor sit amet, consectetur adipisicing elit.
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Products
            </h6>
            <p>
              <a href="#!" class="text-reset">Angular</a>
            </p>
            <p>
              <a href="#!" class="text-reset">React</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Vue</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Laravel</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Useful links
            </h6>
            <p>
              <a href="#!" class="text-reset">Pricing</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Settings</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Orders</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Help</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
            <p><i class="bi bi-house-door-fill footer-i"></i> New York, NY 10012, US</p>
            <p>
              <i class="bi bi-envelope-at-fill footer-i"></i>
              info@example.com
            </p>
            <p><i class="bi bi-telephone-fill footer-i"></i> + 01 234 567 88</p>
            <p><i class="bi bi-telephone-fill footer-i"></i>+ 01 234 567 89</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->
    <hr class="bg-light">
    <!-- Copyright -->
    <div class="text-center p-3 copy-right">
      © 2021 Copyright:
      <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
  </footer>


  <script src="script//product.js"></script>
</body>

</html>