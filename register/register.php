
<?php
    include ('header.php');
?>

    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            require ('register-process.php');
        }
    ?>

    <section id="register">
        <div class="row m-0">
            <div class="col-lg-4 offset-lg-2">
                <div class="text-center pb-5">
                    <h1 class="login-title text-dark">Đăng Ký Thành Viên</h1>
                    <p class="p-1 m-0 font-ubuntu text-black-50">Đăng ký để có thể sử dụng những dịch vụ tốt nhất</p>
                    <span class="font-ubuntu text-black-50">Bạn đã có tài khoản? <a href="login.php"> Đăng nhập</a></span>
                </div>
                <div class="upload-profile-image d-flex justify-content-center pb-5">
                    <div class="text-center">
                        <div class="d-flex justify-content-center">
                            <img class="camera-icon" src="./assets/camera-solid.svg" alt="camera">
                        </div>
                        <img src="./assets/profile/beard.png" style="width: 200px; height: 200px" class="img rounded-circle" alt="profile">
                        <small class="form-text text-black-50">Chọn hình ảnh</small>
                        <input type="file" form="reg-form" class="form-control-file" name="profileUpload" id="upload-profile">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <form action="register.php" method="post" enctype="multipart/form-data" id="reg-form">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name'];  ?>" name="first_name" id="first_name" class="form-control" placeholder="Tên">
                            </div>
                            <div class="col">
                                <input type="text" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name'];  ?>" name="last_name" id="last_name" class="form-control" placeholder="Họ">
                            </div>
                        </div>

                        <div class="form-row my-4">
                            <div class="col">
                                <input type="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];  ?>" required name="email" id="email" class="form-control" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-row my-4">
                            <div class="col">
                                <input type="password" required name="password" id="password" class="form-control" placeholder="Mật Khẩu">
                            </div>
                        </div>

                        <div class="form-row my-4">
                            <div class="col">
                                <input type="password" required name="confirm_pwd" id="confirm_pwd" class="form-control" placeholder="Xác nhận mật khẩu">
                                <small id="confirm_error" class="text-danger"></small>
                            </div>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="agreement" class="form-check-input" required>
                            <label for="agreement" class="form-check-label font-ubuntu text-black-50">Tôi đồng ý với các <a href="#">điều khoản, chính sách và điều kiện </a></label>
                        </div>

                        <div class="submit-btn text-center my-5">
                            <button type="submit" class="btn btn-warning rounded-pill text-dark px-5">Tiếp tục</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </section>


<?php
    include ('footer.php');
?>