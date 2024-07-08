<?php
include_once '../config/database.php';
include_once '../objects/pay.php';
require_once ('database.php');

$pay = new Pay($con);

$pay_id = isset($_POST['pay_id']) ? $_POST['pay_id'] : die();

$bill_id = $_POST['bill_id'];

if ($pay->pay_bill($pay_id)) {
    $response = array(
        "status" => true,
        "message" => "Cập nhật trạng thái hóa đơn thành công!"
    );
} else {
    $response = array(
        "status" => false,
        "message" => "Cập nhật trạng thái hóa đơn thất bại!"
    );
}
echo json_encode($response);