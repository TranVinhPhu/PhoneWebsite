// Gọi API để lấy dữ liệu thống kê
fetch('get_stats.php')
  .then(response => response.json())
  .then(data => {
    // Lấy dữ liệu từ API
    const totalBills = data.total_bills;
    const totalRevenue = data.total_revenue;

    // Tạo biểu đồ
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Tổng số hóa đơn', 'Tổng doanh thu'],
        datasets: [{
          label: 'Dữ liệu thống kê',
          data: [totalBills, totalRevenue],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  })
  .catch(error => console.error('Lỗi:', error));