$(document).ready(function() {
    $('#productTable').DataTable({
        responsive: true,
        "processing": true,
        dom: '<"top"lf>rt<"bottom"ipB>',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        lengthMenu: [
            [5, 10, 15, -1],
            [5, 10, 15, "All"]
        ],
        info: false,
        columnDefs: [{
            orderable: false,
            targets: [5, 6]
        }]
    });

});

function hideEditForm() {
    document.getElementById('editContainer').style.display = "none";
}

function editProduct(productId) {
    fetch('../admin', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'productId=' + encodeURIComponent(productId)
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }

            document.getElementById('eproductId').value = data.id;
            document.getElementById('eproductName').value = data.product_name;
            document.getElementById('eproductCategory').value = data.category_id;
            document.getElementById('eprice').value = data.price;
            document.getElementById('edescription').value = data.description;
            // document.getElementById('eproductImagePreview').src = data.image;

            document.getElementById('editContainer').style.display = "block";
        })
        .catch(error => console.error('Error fetching product:', error));
}

function deleteProduct(productId) {
    if (confirm("Are you sure you want to delete this product?")) {
        fetch('../includes/delete_product', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'productId=' + encodeURIComponent(productId)
            })
            .then(response => window.location.reload())
            .catch(error => console.error('Error:', error));
    }
}