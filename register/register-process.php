<?php
session_start();
require ('helper.php');

$error = array();

$first_name = validate_input_text($_POST['first_name']);
if (empty($first_name)){
    $error[] = "Bạn chưa nhập Tên";
}

$last_name = validate_input_text($_POST['last_name']);
if (empty($last_name)){
    $error[] = "Bạn chưa nhập Họ";
}

$email = validate_input_email($_POST['email']);
if (empty($email)){
    $error[] = "Bạn chưa nhập Email";
}

$password = validate_input_text($_POST['password']);
if (empty($password)){
    $error[] = "Bạn chưa nhập Password";
}

$confirm_pwd = validate_input_text($_POST['confirm_pwd']);
if (empty($confirm_pwd)){
    $error[] = "Bạn chưa nhập Xác Nhận Password";
}

$files = $_FILES['profileUpload'];
$profileImage = upload_profile('./assets/profile/', $files);

if(empty($error)){
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    require ('mysqli_connect.php');

    $query = "INSERT INTO user(user_id, first_name, last_name, email, password, profileImage, register_date)";
    $query .= "VALUES(' ', ?, ?, ?, ?, ?, NOW())";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    mysqli_stmt_bind_param($q, 'sssss', $first_name, $last_name, $email, $hashed_pass, $profileImage);

    mysqli_stmt_execute($q);

    if(mysqli_stmt_affected_rows($q) == 1){
        $_SESSION['user_id'] = mysqli_insert_id($con);
        $_SESSION['last_name'] = $last_name;

        header('location: ./login.php');
        exit();
    } else {
        print "Lỗi khi đăng ký...!";
    }
} else {
    echo 'Chưa validate';
}
?>
