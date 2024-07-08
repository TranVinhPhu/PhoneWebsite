<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('mysqli_connect.php');
require_once('helper.php');

$error = array();

$email = validate_input_email($_POST['email']);
if (empty($email)){
    $error[] = "Bạn chưa nhập Email";
}

$password = validate_input_text($_POST['password']);
if (empty($password)){
    $error[] = "Bạn chưa nhập mật khẩu";
}

if(empty($error)){
    $query = "SELECT user_id, first_name, last_name, email, password, profileImage FROM user WHERE email=?";
    $q = mysqli_stmt_init($con);
    mysqli_stmt_prepare($q, $query);

    mysqli_stmt_bind_param($q, 's', $email);

    mysqli_stmt_execute($q);

    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if (!empty($row)){
        if ($email == 'lieuhoanglong@gmail.com' && $password == '1234567') {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            header("Location: ../admin/Admin");
            exit();
        }
        if(password_verify($password, $row['password'])){
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            
            header("location: ../index.php");
            exit();
        } else {
            echo '<script>alert("Mật khẩu không đúng!"); window.location.href = "login.php";</script>';
        }
    } else {
        echo '<script>alert("Bạn chưa phải là thành viên. Vui lòng đăng ký!"); window.location.href = "register.php";</script>';
    }
} else {
    echo '<script>alert("Nhập Email và Mật Khẩu để tiếp tục!"); window.location.href = "login.php";</script>';
}
?>