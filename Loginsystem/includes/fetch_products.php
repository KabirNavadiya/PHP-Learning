<?php
require_once 'includes/dbh.inc.php'; // Include the database connection

// Get DataTables parameters
$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;
$length = isset($_GET['length']) ? (int)$_GET['length'] : 10;
$searchValue = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';

// Get the total records count
$queryTotal = "SELECT COUNT(*) FROM products";
$stmtTotal = $conn->prepare($queryTotal);
$stmtTotal->execute();
$totalRows = $stmtTotal->fetchColumn();

// SQL query to fetch filtered products
$queryFiltered = "SELECT p.id AS id, p.product_name AS product_name, c.name AS category_name, 
                        p.price AS price, p.description AS description, p.image AS image 
                  FROM products p 
                  JOIN categories c ON p.category_id = c.id 
                  WHERE p.product_name LIKE :search 
                  ORDER BY p.id ASC 
                  LIMIT :start, :length";

$stmtFiltered = $conn->prepare($queryFiltered);
$stmtFiltered->bindValue(':search', '%' . $searchValue . '%', PDO::PARAM_STR);
$stmtFiltered->bindValue(':start', $start, PDO::PARAM_INT);
$stmtFiltered->bindValue(':length', $length, PDO::PARAM_INT);
$stmtFiltered->execute();

$productsData = $stmtFiltered->fetchAll(PDO::FETCH_ASSOC);

// Prepare the JSON response
$response = [
    'draw' => isset($_GET['draw']) ? (int)$_GET['draw'] : 1,
    'recordsTotal' => $totalRows,
    'recordsFiltered' => $totalRows, // This can be updated to reflect the filtered count
    'data' => $productsData
];

// Send the JSON response
echo json_encode($response);
?>
