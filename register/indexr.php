<?php
session_start();
include ('header.php');
include ('helper.php');

$user = array();

if (isset($_SESSION['user_id'])) {
    require ('mysqli_connect.php');
    $user = get_user_info($con, $_SESSION['user_id']);
} else {
    header('Location: register/login.php');
    exit();
}
?>

<section id="main-site">
    <div class="container py-5">
        <div class="row">
            <div class="col-4 offset-4 shadow py-4">
                <div class="upload-profile-image d-flex justify-content-center pb-5">
                    <div class="text-center">
                        <img class="img rounded-circle" style="width: 200px; height: 200px;" src="<?php echo isset($user['profileImage']) ? $user['profileImage'] : './assets/profile/beard.png'; ?>" alt="">
                        <h4 class="py-3">
                            <?php
                            if (isset($user['first_name'])) {
                                printf('%s %s', $user['last_name'], $user['first_name']);
                            }
                            ?>
                        </h4>
                    </div>
                </div>

                <div class="user-info px-3">
                    <ul class="font-ubuntu navbar-nav">
                        <li class="nav-link"><b>Tên: </b><span><?php echo isset($user['first_name']) ? $user['first_name'] : ''; ?></span></li>
                        <li class="nav-link"><b>Họ: </b><span><?php echo isset($user['last_name']) ? $user['last_name'] : ''; ?></span></li>
                        <li class="nav-link"><b>Email: </b><span><?php echo isset($user['email']) ? $user['email'] : ''; ?></span></li>
                    </ul>
                </div>

                <div class="d-flex justify-content-center py-3">
                    <a style="margin-right: 30px;" href="../index.php" class="btn btn-primary">Trang Chủ</a>
                    <a href="logout.php" class="btn btn-danger">Đăng Xuất</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "footer.php";
?>
