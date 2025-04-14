<?php

$dom = new DOMDocument('1.0','UTF-8');
$dom -> formatOutput = true;
$products = $dom->createElement('products');

// Array of products
$productList = [
    ['id' => 101, 'name' => 'Mouse', 'price' => 299, 'category' => 'Accessories'],
    ['id' => 102, 'name' => 'Keyboard', 'price' => 499, 'category' => 'Accessories'],
    ['id' => 103, 'name' => 'Monitor', 'price' => 7999, 'category' => 'Display'],
    ['id' => 104, 'name' => 'Laptop', 'price' => 45999, 'category' => 'Computers'],
];

foreach($productList as $item){
    $product = $dom->createElement('product');

    $id =$dom->createElement('id',$item['id']);
    $name =$dom->createElement('name',$item['name']);
    $price =$dom->createElement('price',$item['price']);
    $category =$dom->createElement('category',$item['category']);

    $product->appendChild($id);
    $product->appendChild($name);
    $product->appendChild($price);
    $product->appendChild($category);

    $products->appendChild($product);

}

$dom->appendChild($products);
$dom->save('xmlExample/products.xml');
echo "✅ XML file created successfully.";