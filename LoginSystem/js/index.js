function showModal(modalId) {
    document.getElementById(modalId).style.display = "flex";
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
    window.location.reload();
}

function RedirectToLogin() {
    window.location.href = "../login.php";
}

function RedirectTocart() {
    window.location.href = "../cart.php";
}
document.addEventListener("DOMContentLoaded", function() {
      
    var dotElement = document.getElementById("dot");

    if (cartCount > 0) {
      dotElement.style.display = "block";
    } else {
      dotElement.style.display = "none";
    }
  });
function addToCart(productId) {
    if (!isLoggedIn) {
        showModal("loginModal");
    } else {
        $.ajax({
            url: "../includes/addtocart.php",
            type: "POST",
            data: {
                productId: productId
            },
            success: function (response) {
                showModal("AddedToCartModal");
            },
            error: function (xhr, status, error) {
                alert("❌ Error: " + xhr.responseText);
            }
        });
    }
}