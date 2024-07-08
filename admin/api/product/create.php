<?php
include_once '../config/database.php';
include_once '../objects/product.php';
require_once ('database.php');

$product = new Product($con);

$product->item_brand = $_POST['item_brand'];
$product->item_name = $_POST['item_name'];
$product->item_price = $_POST['item_price'];
$product->item_description = $_POST['item_description'];

$files = $_FILES['imageUpload'];
$product->item_image = $product->upload_image('./assets/products/', $files);

if ($product->create()) {
    $product_arr = array(
        "status" => true,
        "message" => "Product created successfully!",
        "item_id" => $product->item_id,
        "item_brand" => $product->item_brand,
        "item_name" => $product->item_name,
        "item_price" => $product->item_price,
        "item_image" => $product->item_image
    );
} else {
    $product_arr = array(
        "status" => false,
        "message" => "Product creation failed!"
    );
}
print_r(json_encode($product_arr));
?>
