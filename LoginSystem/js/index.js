function showModal(modalId) {
    document.getElementById(modalId).style.display = "flex";
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
    window.location.reload();
}

function RedirectToLogin() {
    window.location.href = "/login";
}

function RedirectTocart() {
    window.location.href = "/cart";
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
            url: "../includes/addtocart",
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