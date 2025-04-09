
function updateQuantity(cartProductId, action) {

    $.ajax({
        url: "../includes/updatecart",
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
        url: "../includes/fetchcart",
        type: "GET",
        dataType: "json",
        success: function(response) {
            if (!response.error) {                
                $("#cart-table-body").html(response.cart_html); 
                if (response.hasItems) {
                    let pricesummary = $('<div>',{id:'price-summary'});
                    $('.cart-wrapper').append(pricesummary);
                    $("#price-summary").html(response.price_summary).show();
                    $("#add-items").hide();
                }
                else{
                    $("#price-summary").hide();
                    $("#add-items").show();
                } 
                $("#total").html("&#8377;"+response.total);
                $("#discount").html("- &#8377;"+response.totaldiscount);
                $("#subtotal").html("&#8377;"+response.subtotal);
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