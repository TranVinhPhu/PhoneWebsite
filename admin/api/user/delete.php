<?php

include_once '../config/database.php';
include_once '../objects/user.php';
require_once ('database.php');

$user = new User($con);

$user->user_id = $_POST['user_id'];

if ($user->delete()) {
    $user_arr = array(
        "status" => true,
        "message" => "Successfully Removed!"
    );
} else {
    $user_arr = array(
        "status" => false,
        "message" => "User cannot be deleted."
    );
}
print_r(json_encode($user_arr));
?>
