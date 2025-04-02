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

    $("#checkout-btn").click(function() {
        $.ajax({
            url: "../includes/stripe/stripe_checkout.php",
            type: "POST",
            dataType: "json",
            success: function(response) {
                if (response.sessionId) {
                    var stripe = Stripe("pk_test_51R8hUaQqhlBH6hwWm7Qyn0GH1dWSEH656p5rIBbHRqJSPCMhwad43AIgXYS9sKl6NK3uW1QHnaOHhtbLVP6cJ7yk00aNsD0owq");
                    stripe.redirectToCheckout({
                        sessionId: response.sessionId
                    });
                } else {
                    alert("Error: " + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    });
});