<?php
session_start();
include_once '../objects/product.php';
require_once ('database.php');

$product = new Product($con);

$product->item_id = $_POST['item_id'];
$product->item_brand = $_POST['item_brand'];
$product->item_name = $_POST['item_name'];
$product->item_price = $_POST['item_price'];
$product->item_description = $_POST['item_description'];

$files = $_FILES['imageUpload'];
$product->item_image = $product->upload_image('./assets/products/', $files);

if ($product->update()) {
    $product_arr = array(
        "status" => true,
        "message" => "Product updated successfully!"
    );
} else {
    $product_arr = array(
        "status" => false,
        "message" => "Product update failed!"
    );
}
print_r(json_encode($product_arr));
?>
