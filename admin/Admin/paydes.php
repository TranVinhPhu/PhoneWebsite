<?php
    include './paydesfunc.php';
?>
<?php
$content = '<div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách chi tiết hóa đơn</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="bills" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Mã chi tiết hóa đơn</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>';

foreach ($billDetails as $detail) {
    $content .= '<tr>
        <td>' . $detail['billdes_id'] . '</td>
        <td>' . $detail['item_id'] . '</td>
        <td>' . $detail['quantity'] . '</td>
        <td>' . $detail['price'] . '</td>
        <td>
            <a href="./allpay.php">Quay lại</a>
        </td>
    </tr>';
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
<!-- /.box-body -->
</div>
<!-- /.box -->
</div>
</div>';

include('../master.php');
?>