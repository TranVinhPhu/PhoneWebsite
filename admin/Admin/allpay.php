<?php
    include './allpayfunc.php';
    $email = "lieuhoanglong.91@gmail.com";
    $perPage = 7;

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    $totalBills = count($billData);
    $totalPages = ceil($totalBills / $perPage);

    $startIndex = ($currentPage - 1) * $perPage;
    $endIndex = $startIndex + $perPage;

    $pagedBillData = array_slice($billData, $startIndex, $perPage);
    $previousPage = max(1, $currentPage - 1);
    $nextPage = min($totalPages, $currentPage + 1);
    $startIndex = ($currentPage - 1) * $perPage;
    $pagedBillData = array_slice($billData, $startIndex, $perPage);


    $pagination = '<div class="pagination-container">';
    $pagination .= '<div class="pagination">';
    if ($currentPage > 1) {
        $pagination .= '<a href="?page=' . ($currentPage - 1) . '">&lt;</a>';
    }
    for ($i = 1; $i <= $totalPages; $i++) {
        $pagination .= '<a href="?page=' . $i . '">' . $i . '</a>';
    }
    if ($currentPage < $totalPages) {
        $pagination .= '<a href="?page=' . ($currentPage + 1) . '">&gt;</a>';
    }
    $pagination .= '</div>';
    $pagination .= '</div>';

    $content = '<div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách hóa đơn</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="bills" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Mã hóa đơn</th>
                                        <th>Ngày thanh toán</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>';

    foreach ($pagedBillData as $bill) {
        $paystatus = ($bill['paystatus'] == 'Paid') ? 'Paid' : 'Unpaid';
        $content .= '<tr>
            <td>' . $bill['bill_id'] . '</td>
            <td>' . $bill['pay_date'] . '</td>
            <td>' . $bill['total'] . '</td>
            <td>' . $paystatus . '</td>
            <td>';
        if ($paystatus == 'Unpaid') {
            $content .= '<a href="#" onClick="Pay(' . $bill['pay_id'] . ', ' . $bill['bill_id'] . ')">Thanh toán</a> | ';
        }

        $content .= '<a href="#" onClick="ViewDetails(' . $bill['bill_id'] . ')">Chi tiết</a>';

        $content .= '</td></tr>';
                
    }

    $content .= '</tbody>
        <tfoot>
            <tr>
                <th>Mã hóa đơn</th>
                <th>Ngày thanh toán</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </tfoot>
    </table>
    </div>
    </div>
    </div>
    </div>';

    $content .= $pagination;

    include('../master.php');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var userEmail = "<?php echo $email; ?>";
    function Pay(pay_id, bill_id) {
        console.log(pay_id, bill_id);
        var result = confirm("Bạn có muốn thanh toán hóa đơn này?");
        if (result == true) {
            $.ajax({
                type: "POST",
                url: '../api/pay/update.php',
                dataType: 'json',
                data: {
                    pay_id: pay_id,
                    bill_id: bill_id
                },
                success: function (result) {
                    if (result.status) {
                        var user_email = result.user_email;
                        var first_name = result.first_name;
                        sendEmail(userEmail, first_name, pay_id, bill_id);
                    } else {
                        alert(result.message);
                    }
                },
                error: function (result) {
                    alert(result.responseText);
                }
            });
        }
    }

    function sendEmail(email, first_name, pay_id, bill_id) {
        $.ajax({
            type: "POST",
            url: '../api/pay/paymail.php',
            data: {
                email: email,
                first_name: first_name,
                pay_id: pay_id,
                bill_id: bill_id
            },
            success: function(response) {
                console.log(response);
                alert("Hóa đơn đã được thanh toán thành công và email đã được gửi!");
                window.location.href = 'allpay.php';
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Hóa đơn đã được thanh toán thành công nhưng không thể gửi email.");
                window.location.href = 'allpay.php';
            }
        });
    }

    function ViewDetails(bill_id){
        window.location.href = 'paydes.php?bill_id=' + bill_id;
    }
</script>