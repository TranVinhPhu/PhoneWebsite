<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thống kê</title>
  <!-- Bao gồm thư viện Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  
  <?php
    $content = '
        <h1>Thống kê hóa đơn</h1>
        <canvas id="myChart"></canvas>
    ';
    include('../master.php');?>

  <!-- Nhúng mã JavaScript để gọi API và vẽ biểu đồ -->
  <script src="thongke.js"></script>
</body>
</html>
