<?php
include_once '../config/database.php';
include_once '../objects/user.php';
require_once ('database.php');

$user = new User($con);

$user->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

$stmt = $user->read_single();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $user_arr = array(
        "user_id" => $row['user_id'],
        "first_name" => $row['first_name'],
        "last_name" => $row['last_name'],
        "email" => $row['email'],
        "password" => $row['password'],
        "profileImage" => '../../register/assets/profile/' . basename($row['profileImage']),
        "register_date" => $row['register_date']
    );
    print_r(json_encode($user_arr));
} else {
    echo json_encode(array("message" => "User not found."));
}
?>
