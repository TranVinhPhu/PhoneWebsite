<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['product_submit'])){
            $Cart->addToCartID($_POST['user_id'], $_POST['item_id']);
        }
        if (isset($_POST['product_buynow'])){
            $Cart->addToCartIDBuyNow($_POST['user_id'], $_POST['item_id']);
        }
    }

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }
    $item_id = $_GET['item_id'] ?? 1;
    foreach ($product->getData() as $item) :
        if ($item['item_id'] == $item_id) :
?>
<section id="product" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <img src="<?php echo $item['item_image'] ?? "./assets/products/1.png" ?>" alt="product" class="img-fluid">
                <div class="form-row pt-4 font-size-16 font-baloo" style="display: flex; gap: 10px;">
                    <div class="col">
                            <form method="post">
                                <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? '1'; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $user_id ?? '1'; ?>">
                                <button type="submit" name="product_buynow" class="btn btn-danger form-control">Mua Ngay</button>
                            </form>
                    </div>
                    <div class="col">
                        <form method="post">
                            <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? '1'; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $user_id ?? '1'; ?>">
                            <?php
                            if (in_array($item['item_id'], $Cart->getCartId($product->getData('cart')) ?? [])){
                                echo '<button type="submit" disabled name="product_submit" class="btn btn-success form-control"">Trong Giỏ</button>';
                            }else{
                                echo '<button type="submit" name="product_submit" class="btn btn-warning form-control"">Thêm Vào Giỏ</button>';
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 py-5">
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
                    <a href="#" class="px-2 font-rale font-size-14">20,534 đánh giá| 1000+ câu trả lời</a>
                </div>
                <hr class="m-0">

                <table class="my-3">
                    <tr class="font-rale font-size-14">
                        <td>Giá niêm yết:</td>
                        <td><strike>16.200.000 VNĐ</strike></td>
                    </tr>
                    <tr class="font-rale font-size-14">
                        <td>Giá sản phẩm:</td>
                        <td class="font-size-20 text-danger"><span><?php echo number_format($item['item_price'] ?? 0, 0, ',', '.') ?>VNĐ</span>VNĐ<small class="text-dark font-size-12">&nbsp;&nbsp;Đã bao gồm thuế</small></td>
                    </tr>
                    <tr class="font-rale font-size-14">
                        <td>Tiết kiệm:</td>
                        <td><span class="font-size-16 text-danger">1.200.000 VNĐ</span></td>
                    </tr>
                </table>

                <div id="policy">
                    <div class="d-flex">
                        <div class="return text-center mr-5">
                            <div class="font-size-20 my-2 color-second">
                                <span class="fas fa-retweet border p-3 rounded-pill"></span>
                            </div>
                            <a href="#" class="font-rale font-size-12">10 Ngày <br> Đổi trả</a>
                        </div>
                        <div class="return text-center mr-5" style="margin: 0 10px">
                            <div class="font-size-20 my-2 color-second">
                                <span class="fas fa-truck  border p-3 rounded-pill"></span>
                            </div>
                            <a href="#" class="font-rale font-size-12"> <br>Tận nơi</a>
                        </div>
                        <div class="return text-center mr-5">
                            <div class="font-size-20 my-2 color-second">
                                <span class="fas fa-check-double border p-3 rounded-pill"></span>
                            </div>
                            <a href="#" class="font-rale font-size-12">1 Năm <br>Bảo hành</a>
                        </div>
                    </div>
                </div>

                <hr>

                <div id="order-details" class="font-rale d-flex flex-column text-dark">
                    <small>Ngày giao hàng : Mar 29  - Apr 1</small>
                    <small>Bán bởi <a href="#">LPK Shop </a>(4.5 trên 5 | 18,198 đánh giá)</small>
                    <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Giao tới khách hàng - 424201</small>
                </div>

                    <div class="col-6">
                        <div class="color my-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="font-baloo">Màu:</h6>
                                <div class="p-2 color-yellow-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                <div class="p-2 color-primary-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                <div class="p-2 color-second-bg rounded-circle"><button class="btn font-size-14"></button></div>
                            </div>
                        </div>

                    </div>
                    <div class="col-6">

                        <div class="qty d-flex">
                            <h6 class="font-baloo">Số lượng</h6>
                            <div class="px-4 d-flex font-rale">
                                <button class="qty-up border bg-light" data-id="pro1"><i class="fas fa-angle-up"></i></button>
                                <input type="text" data-id="pro1" class="qty_input border px-2 w-50 bg-light" disabled value="1" placeholder="1">
                                <button data-id="pro1" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
                            </div>
                        </div>

                    </div>

                <div class="size my-3">
                    <h6 class="font-baloo">Bộ nhớ :</h6>
                    <div class="d-flex justify-content-between w-75">
                        <div class="font-rubik border p-2">
                            <button class="btn p-0 font-size-14">4GB RAM</button>
                        </div>
                        <div class="font-rubik border p-2">
                            <button class="btn p-0 font-size-14">6GB RAM</button>
                        </div>
                        <div class="font-rubik border p-2">
                            <button class="btn p-0 font-size-14">8GB RAM</button>
                        </div>
                    </div>
                </div>


            </div>

            <div class="col-12">
                <h6 class="font-rubik">Mô Tả Sản Phẩm</h6>
                <hr>
                <p class="font-rale font-size-14">
                    <?php echo $item['item_description'] ?? "No description available"; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<?php
        endif;
        endforeach;
?>