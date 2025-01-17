<?php

if (!function_exists('validate_input_text')) {
    function validate_input_text($textValue) {
        if (!empty($textValue)) {
            $trim_text = trim($textValue);
            $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_STRING);
            return $sanitize_str;
        }
        return '';
    }
}

if (!function_exists('validate_input_email')) {
    function validate_input_email($emailValue) {
        if (!empty($emailValue)) {
            $trim_text = trim($emailValue);
            $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_EMAIL);
            return $sanitize_str;
        }
        return '';
    }
}

function upload_profile($path, $file){
    $targetDir = $path;
    $default = "beard.png";

    $filename = basename($file['name']);
    $targetFilePath = $targetDir . $filename;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    If(!empty($filename)){
        $allowType = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'jfif');
        if(in_array($fileType, $allowType)){
            if(move_uploaded_file($file['tmp_name'], $targetFilePath)){
                return $targetFilePath;
            }
        }
    }

    return $path . $default;
}

function get_user_info($con, $user_id){
    $query = "SELECT first_name, last_name, email, profileImage FROM user WHERE user_id=?";
    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    mysqli_stmt_bind_param($q, 'i', $user_id);

    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result);
    return empty($row) ? false : $row;
}














