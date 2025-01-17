<?php

session_start();

include ('header.php');
include "helper.php";
?>

<?php
    $user_id = "";
    $user = array();
    require ('mysqli_connect.php');

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        $user = get_user_info($con, $_SESSION['user_id']);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require ('login-process.php');
    }
?>

<section id="login-form">
    <div class="row m-0">
        <div class="col-lg-4 offset-lg-2">
            <div class="text-center pb-5">
                <h1 class="login-title text-dark">Đăng nhập</h1>
                <p class="p-1 m-0 font-ubuntu text-black-50">Đăng nhập và bắt đầu sử dụng những dịch vụ tốt nhất</p>
                <span class="font-ubuntu text-black-50">Bạn chưa có tài khoản? <a href="register.php"> Đăng Ký</a></span>
            </div>
            <div class="upload-profile-image d-flex justify-content-center pb-5">
                <div class="text-center">
                    <img src="<?php echo isset($user['profileImage']) ? $user['profileImage'] : './assets/profile/beard.png' ; ?>" style="width: 200px; height: 200px" class="img rounded-circle" alt="profile">
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <form action="login.php" method="post" enctype="multipart/form-data" id="log-form">

                    <div class="form-row my-4">
                        <div class="col">
                            <input type="email" required name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                    </div>

                    <div class="form-row my-4">
                        <div class="col">
                            <input type="password" required name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                    </div>

                    <div class="submit-btn text-center my-5">
                        <button type="submit" class="btn btn-warning rounded-pill text-dark px-5">Đăng Nhập</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>


<?php
include ('footer.php');
?>