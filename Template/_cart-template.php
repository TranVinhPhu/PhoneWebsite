<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once(__DIR__ . '/../functions.php');
$total = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['delete-cart-submit'])){
        $deletedrecord = $Cart->deleteCart($_POST['item_id']);
    }

    if (isset($_POST['wishlist-submit'])){
        $Cart->saveForLater($_POST['item_id']);
    }

    if (isset($_POST['quantity'])) {
        foreach ($_POST['quantity'] as $item_id => $quantity) {
            $product_info = $product->getProduct($item_id);
            
            if ($product_info && $quantity > 0) {
                $subTotal[] = $product_info[0]['item_price'] * $quantity;

                $total = isset($subTotal) ? array_sum($subTotal) : 0;
            }
        }
    }
    if(isset($_POST['checkout']) && isset($_POST['quantity'])){
        if ($total > 0) {
            if (isset($_SESSION['user_id'])) {
                $success = $Cart->createBill($_SESSION['user_id'], $total);

                if ($success) {
                    echo '<script>alert("Thanh toán thành công!");</script>';
                } else {
                    echo '<script>alert("Có lỗi xảy ra khi tạo hóa đơn.");</script>';
                }
            } else {
                echo '<script>alert("Bạn chưa phải là thành viên. Vui lòng đăng ký!");</script>';
            }
        } else {
            echo '<script>alert("Giỏ hàng của bạn trống.");</script>';
        }
    }
}

?>
<section id="cart" class="py-3 mb-5">
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Giỏ hàng</h5>

        <div class="row">
            <div class="col-sm-8">
                <?php
                foreach ($product->getData('cart') as $item) :
                    $cart = $product->getProduct($item['item_id']);
                    $subTotal[] = array_map(function ($item){
                ?>

                <div class="row border-top py-3 mt-3">
                    <div class="col-sm-2">
                        <img src="<?php echo $item['item_image'] ?? "./assets/products/1.png" ?>" style="height: 80px;" alt="cart1" class="img-fluid">
                    </div>
                    <div class="col-sm-6">
                        <h5 class="font-baloo font-size-20"><?php echo $item['item_name'] ?? "Unknown"; ?></h5>
                        <small>by <?php echo $item['item_brand'] ?? "Brand"; ?></small>

                        <div class="d-flex">
                            <div class="rating text-warning font-size-12">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                            <a href="#" class="px-2 font-rale font-size-14">20,534 đánh giá</a>
                        </div>

                        <div class="qty d-flex pt-2">
                            <div class="d-flex font-rale w-25">
                                <button class="qty-up border bg-light" data-id="<?php echo $item['item_id'] ?? '0'; ?>"><i class="fas fa-angle-up"></i></button>
                                <input type="text" name="quantity" data-id="<?php echo $item['item_id']; ?>" class="qty_input border px-2 w-100 bg-light" readonly value="1" placeholder="1">
                                <input type="hidden" name="quantity[<?php echo $item['item_id']; ?>]" value="1">
                                <button data-id="<?php echo $item['item_id'] ?? '0'; ?>" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
                            </div>

                            <form method="post">
                                <input type="hidden" value="<?php echo $item['item_id'] ?? 0; ?>" name="item_id">
                                <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger px-3 border-right">Xóa</button>
                            </form>

                            <form method="post">
                                <input type="hidden" value="<?php echo $item['item_id'] ?? 0; ?>" name="item_id">
                                <button type="submit" name="wishlist-submit" class="btn font-baloo text-danger">Mua Sau</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-sm-4 text-right">
                        <div class="font-size-20 text-danger font-baloo">
                            <span class="product_price" data-id="<?php echo $item['item_id'] ?? '0'; ?>"><?php echo number_format($item['item_price'] ?? 0, 0, ',', '.') ?></span>VNĐ
                        </div>
                    </div>
                </div>

                <?php
                        return $item['item_price'];
                    }, $cart);
                endforeach;
                ?>
            </div>
            <div class="col-sm-4">
                <div class="sub-total border text-center mt-3">
                    <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i> Đơn hàng của bạn được MIỄN PHÍ vận chuyển.</h6>
                    <div class="border-top py-4">
                        <h5 class="font-baloo font-size-20">Tổng tiền ( <?php echo isset($subTotal) ? count($subTotal) : 0; ?> sản phẩm):&nbsp; <span class="text-danger"><span class="text-danger" id="deal-price"><?php echo isset($subTotal) ? $Cart->getSum($subTotal) : 0; ?></span>VNĐ </span> </h5>
                        <form method="post" name="checkout">
                            <button type="submit" name="checkout" class="btn btn-warning mt-3">Thanh toán ngay</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
$(document).ready(function(){
    $(".qty_input").change(function() {
        var quantity = $(this).val();
        var item_id = $(this).data("id");
        $("input[name='quantity[" + item_id + "]']").val(quantity);
    });

    $("form[name='checkout']").submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);
        $(".qty_input").each(function() {
            var quantity = $(this).val();
            var item_id = $(this).data("id");
            formData.append('quantity[' + item_id + ']', quantity);
        });

        formData.append('checkout', '1');

        Swal.fire({
            title: "Xác nhận thanh toán",
            text: "Bạn có chắc chắn muốn thanh toán?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "OK",
            cancelButtonText: "Hủy",
        })
        .then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: './Template/_cart-template.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            title: 'Thành công!',
                            text: 'Thanh toán của bạn đã được xử lý.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            $('#tick').show();
                            setTimeout(function() {
                                window.location.href = "index.php";
                            }, 1500);
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                                title: 'Lỗi!',
                                text: response.message,
                                icon: 'error'
                        });
                        console.log(response.message);
                        console.error(error);
                    }
                });
            }
        });
    });
});
</script>