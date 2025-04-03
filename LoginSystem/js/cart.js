
function updateQuantity(cartProductId, action) {

    $.ajax({
        url: "../includes/updatecart.php",
        type: "POST",
        data: {
            cartProductId: cartProductId,
            action: action
        },
        dataType: "json",

        success: function(response) {
            if (response.success) {
                fetchCart();
            } else {
                alert("❌ Error: " + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
        }
    });
}

function fetchCart() {
    $.ajax({
        url: "../includes/fetchcart.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
            if (!response.error) {
                $("#cart-table-body").html(response.cart_html);
                $(".cart-footer h2").html("Total: ₹" + response.discounted_total_price);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
        }
    });
}
$(document).ready(function() {
    fetchCart();
});