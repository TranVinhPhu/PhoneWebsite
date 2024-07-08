<?php
include_once '../config/database.php';
include_once '../objects/product.php';
require_once ('database.php');

$product = new Product($con);

$product->item_id = isset($_GET['item_id']) ? $_GET['item_id'] : die();

$stmt = $product->read_single();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $product_arr = array(
        "item_id" => $row['item_id'],
        "item_brand" => $row['item_brand'],
        "item_name" => $row['item_name'],
        "item_price" => $row['item_price'],
        "item_image" => '../../assets/products/' . basename($row['item_image']),
        "item_description" => $row['item_description'],
        "item_register" => $row['item_register']
    );
    print_r(json_encode($product_arr));
} else {
    echo json_encode(array("message" => "Product not found."));
}
?>
