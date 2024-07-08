<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lpkshop";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM pay";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $billData = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
}

$conn = null;