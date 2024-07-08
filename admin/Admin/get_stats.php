<?php
// Kết nối đến cơ sở dữ liệu
include_once '../api/config/database.php';

// Kiểm tra kết nối
if ($con->connect_error) {
    die("Kết nối thất bại: " . $con->connect_error);
}

// Truy vấn SQL để lấy thông tin thống kê
$query = "SELECT COUNT(bill_id) AS total_bills, SUM(bill_total) AS total_revenue FROM bill";
$result = $con->query($query);

// Kiểm tra kết quả của truy vấn
if ($result->num_rows > 0) {
    // Lấy dữ liệu từ kết quả và chuyển đổi thành mảng
    $row = $result->fetch_assoc();

    // Chuyển đổi mảng thành JSON
    $json_response = json_encode($row);

    // Xuất JSON
    echo $json_response;
} else {
    // Trường hợp không có dữ liệu
    echo json_encode(array('message' => 'Không có hóa đơn nào được tìm thấy.'));
}

// Đóng kết nối
$con->close();
?>
