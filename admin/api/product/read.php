<?php
include_once '../config/database.php';
include_once '../objects/product.php';
require_once ('database.php');

$product = new Product($con);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? (int)$_GET['pageSize'] : 7;

// Calculate the starting row for the SQL query
$start = ($page - 1) * $pageSize;

$stmt = $product->readPaginated($start, $pageSize);
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $products_arr = array();
    $products_arr["products"] = array();

    while ($row = $result->fetch_assoc()) {
        $product_item = array(
            "item_id" => $row['item_id'],
            "item_brand" => $row['item_brand'],
            "item_name" => $row['item_name'],
            "item_price" => $row['item_price'],
            "item_image" => '../../assets/products/' . basename($row['item_image']),
            "item_description" => $row['item_description'],
            "item_register" => $row['item_register']
        );
        array_push($products_arr["products"], $product_item);
    }

    $totalProducts = $product->countAll();
    $totalPages = ceil($totalProducts / $pageSize);

    // Add totalPages to the response
    $products_arr["totalPages"] = $totalPages;

    echo json_encode($products_arr);
} else {
    echo json_encode(array("message" => "No products found."));
}