<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lpkshop";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (!isset($_GET['bill_id'])) {
        die("Missing bill_id parameter");
    }

    $bill_id = $_GET['bill_id'];
    
    $sql = "SELECT * FROM billdes WHERE bill_id = :bill_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':bill_id', $bill_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $billDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($billDetails)) {
        die("No details found for this bill.");
    }
} catch(PDOException $e) {
    echo "Connection error: " . $e->getMessage();
}