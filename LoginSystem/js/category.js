$(document).ready(function() {
    $('#categoryTable').DataTable({
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
            targets: [2]
        }]
    });

});

function hideCategoryForm() {
    document.getElementById('editContainer').style.display = "none";
    document.getElementById('addcontainer').style.display = "block";

}

function editCategory(categoryid) {
    document.getElementById('addcontainer').style.display = "none";
    fetch('../category', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'categoryId=' + encodeURIComponent(categoryid)
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            document.getElementById('ecategoryid').value = data.id;
            document.getElementById('ecategoryname').value = data.name;
            document.getElementById('editContainer').style.display = "block";
        })
        .catch(error => alert('Failed to fetch category. Please try again.'));
}


function deleteCategory(categoryid) {
    if (confirm("Are you sure you want to delete this product?")) {
        fetch('../includes/delete_category', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'categoryId=' + encodeURIComponent(categoryid)
            })
            .then(response => window.location.reload())
            .catch(error => console.error('Error:', error));
    }
}