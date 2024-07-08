<?php
include_once '../config/database.php';
include_once '../objects/product.php';
require_once ('database.php');

$product = new Product($con);

$product->item_id = $_POST['item_id'];

if ($product->delete()) {
    $product_arr = array(
        "status" => true,
        "message" => "Product deleted successfully!"
    );
} else {
    $product_arr = array(
        "status" => false,
        "message" => "Product deletion failed!"
    );
}
print_r(json_encode($product_arr));
?>
