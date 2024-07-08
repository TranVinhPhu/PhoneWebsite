<?php
session_start();

include_once '../config/database.php';
include_once '../objects/user.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../PHPMailer-master/src/Exception.php';
require '../../../PHPMailer-master/src/PHPMailer.php';
require '../../../PHPMailer-master/src/SMTP.php';

$pay_id = $_POST['pay_id'];
if (isset($_POST['bill_id'])) {
    $bill_id = $_POST['bill_id'];
} else {
    echo "Không có dữ liệu bill_id được gửi.";
    exit;
}

$email = "lieuhoanglong.91@gmail.com";
$user_id = $_SESSION['user_id'];

$con = new mysqli($host, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$user = new User($con);
$user->user_id = $user_id;
$stmt = $user->read_single();

if ($stmt->num_rows > 0) {
    $row = $stmt->fetch_assoc();
    $user_email = $row['email'];

    sendEmail($email, $row['first_name'], $pay_id, $bill_id, $con);
} else {
    echo "User not found.";
}

function sendEmail($email, $first_name, $pay_id, $bill_id, $con)
{
    $query = "SELECT bd.quantity, p.item_name, p.item_image 
              FROM billdes bd 
              INNER JOIN product p ON bd.item_id = p.item_id 
              WHERE bd.bill_id = ?";
    $stmt1 = $con->prepare($query);
    $stmt1->bind_param('i', $bill_id);
    $stmt1->execute();
    $result = $stmt1->get_result();

    $emailContent = "Xin chào, " . $first_name . "<br>Đơn hàng của bạn gồm các sản phẩm sau:<br>";
    $embeddedImages = [];
    while ($row = $result->fetch_assoc()) {
        $emailContent .= $row['quantity'] . " " . $row['item_name'] . "<br>";
        
        $imagePath = realpath(__DIR__ . '/../../../' . ltrim($row['item_image'], './'));
        
        echo 'Image Path: ' . $imagePath . '<br>';

        if ($imagePath && file_exists($imagePath)) {
            $cid = basename($row['item_image']);
            $emailContent .= '<img src="cid:' . $cid . '" width="100px"><br>';
            $embeddedImages[$cid] = $imagePath;
        } else {
            echo 'Could not access file: ' . $imagePath . '<br>';
        }
    }

    $query = "SELECT total FROM pay WHERE pay_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $pay_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $total = $row['total'];

    $emailContent .= "Tổng tiền là: " . $total;
    $emailContent .= "<br>Xin chân thành cảm ơn bạn đã ghé thăm và ủng hộ LPK Shop!";

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'lieuhoanglong.91@gmail.com';
        $mail->Password = 'xozs msdf gkry lcsm';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->CharSet = 'UTF-8';
        $mail->setFrom('lieuhoanglong.91@gmail.com', 'LPK Shop');
        $mail->addAddress($email);

        foreach ($embeddedImages as $cid => $imagePath) {
            $mail->addEmbeddedImage($imagePath, $cid);
        }

        $mail->isHTML(true);
        $mail->Subject = 'Thông báo yêu cầu hóa đơn được chấp thuận';
        $mail->Body = $emailContent;

        $mail->send();
        echo 'Email đã được gửi thành công.';
    } catch (Exception $e) {
        echo 'Không thể gửi email. Mailer Error: ', $mail->ErrorInfo;
    }
}