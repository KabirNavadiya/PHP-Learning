$(document).on("click", ".view-btn", function() {
    var orderId = $(this).data("order-id");
    $.ajax({
        url: "../includes/order_details.php",
        type: "POST",
        data: {
            orderId: orderId
        },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                displayOrderDetails(response.order_details, orderId);
            } else {
                alert("❌ Error: " + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
        }
    });
});


function displayOrderDetails(orderDetails, orderId) {
    var containerId = "#order-details-container-" + orderId;

    $(containerId).html('');
    var header = "<h2 id='order-details'>Order Details</h2>";
    $(containerId).append(header);
    orderDetails.forEach(product => {
        var productHtml = `

        <div class="order-item">
        <div class="order-info">
            <p class="product-name"><strong>Product Name:</strong> ${product.product_name}</p>
            <div class="product-image-container">
                <img src="${product.product_image}" alt="${product.product_name}" class="product-image">
            </div>
            <p><strong>Quantity:</strong> ${product.quantity}</p>
            <p><strong>Price:</strong> ₹${product.product_price}</p>
        </div>
        <p class="total-price"><strong>Total:</strong> ₹${product.total_amount}</p>
    </div>
`;
        $(containerId).append(productHtml);
    });

    $(containerId).slideToggle('slow');
}