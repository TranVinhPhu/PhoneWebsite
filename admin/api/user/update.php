<?php
session_start();
include_once '../objects/user.php';
require_once ('database.php');

$user = new User($con);

$user->user_id = $_POST['user_id'];
$user->first_name = $_POST['first_name'];
$user->last_name = $_POST['last_name'];
$user->email = $_POST['email'];
$user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$files = $_FILES['profile_Upload'];
$user->profileImage = $user->upload_profile('./assets/profile/', $files);

if ($user->update()) {
    $user_arr = array(
        "status" => true,
        "message" => "Successfully Updated!"
    );
} else {
    $user_arr = array(
        "status" => false,
        "message" => "Email already exists!"
    );
}
print_r(json_encode($user_arr));
?>