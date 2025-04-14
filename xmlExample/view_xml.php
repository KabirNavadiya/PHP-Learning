<?php

$dom = new DOMDocument();
$dom->load('products.xml');
$products = $dom->getElementsByTagName('product');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Catalog</title>
    <style>
        table { border-collapse: collapse; width: 50%; margin: 20px auto; }
        th, td { padding: 8px 12px; border: 1px solid #999; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Product Catalog (From XML)</h2>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Price</th><th>Category</th>
        </tr>

        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product->getElementsByTagName('id')[0]->nodeValue ?></td>
                <td><?= $product->getElementsByTagName('name')[0]->nodeValue ?></td>
                <td>₹<?= $product->getElementsByTagName('price')[0]->nodeValue ?></td>
                <td><?= $product->getElementsByTagName('category')[0]->nodeValue ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>