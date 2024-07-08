<?php
include_once '../config/database.php';
include_once '../objects/user.php';

$user = new User($con);

// Get current page and page size from the request, default to 1 and 7 respectively
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? (int)$_GET['pageSize'] : 7;

// Calculate the starting row for the SQL query
$start = ($page - 1) * $pageSize;

$stmt = $user->readPaginated($start, $pageSize);
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $users_arr = array();
    $users_arr["users"] = array();

    while ($row = $result->fetch_assoc()) {
        $user_item = array(
            "user_id" => $row['user_id'],
            "first_name" => $row['first_name'],
            "last_name" => $row['last_name'],
            "email" => $row['email'],
            "profileImage" => '../../register/assets/profile/' . basename($row['profileImage']),
            "register_date" => $row['register_date']
        );
        array_push($users_arr["users"], $user_item);
    }

    // Calculate total users and total pages
    $totalUsers = $user->countAll();
    $totalPages = ceil($totalUsers / $pageSize);

    // Add totalPages to the response
    $users_arr["totalPages"] = $totalPages;

    echo json_encode($users_arr);
} else {
    echo json_encode(array("message" => "No users found."));
}