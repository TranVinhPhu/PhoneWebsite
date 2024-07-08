<?php
include_once '../config/database.php';
include_once '../objects/user.php';
require_once ('database.php');

$user = new User($con);

$user->first_name = $_POST['first_name'];
$user->last_name = $_POST['last_name'];
$user->email = $_POST['email'];
$user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$files = $_FILES['profileUpload'];
$user->profileImage = $user->upload_profile('./assets/profile/', $files);

if ($user->create()) {
    $user_arr = array(
        "status" => true,
        "message" => "Successfully Signup!",
        "user_id" => $user->user_id,
        "first_name" => $user->first_name,
        "last_name" => $user->last_name,
        "email" => $user->email,
        "profileImage" => $user->profileImage
    );
} else {
    $user_arr = array(
        "status" => false,
        "message" => "Email already exists!"
    );
}
print_r(json_encode($user_arr));
?>
