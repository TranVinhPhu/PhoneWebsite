<?php
define('BASE_URL', 'http://localhost/DoAnPHP_WebsiteDienThoai/');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPK Shop</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    <link rel="stylesheet" href="style.css">

    <?php
    require_once ('functions.php');
    ?>

</head>
<body>
<header id="header">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #20c997;">
        <a class="navbar-brand" href="index.php" style="padding-left: 10px;">LPK Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <form action="<?=BASE_URL?>index.php" method="GET" class="font-size-14 font-rale m-auto position-relative" id="form-search">
                <div class="input-group" style="width:25vw">
                    <input type="text" autocomplete="off" class="form-control" placeholder="Tìm kiếm sản phẩm..." name="q" >
                    <button class="btn btn-outline-light" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                </div>
                <div class="live-search-result">
                    <ul class="search-result">
                    </ul>
                </div>
            </form>
            <form action="#" class="font-size-14 font-rale">
                <a href="cart.php" class="py-2 rounded-pill color-primary-bg">
                    <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
                    <span class="px-3 py-2 rounded-pill text-dark bg-light"><?php include('cartcount.php');?></span>
                </a>
            </form>
            <div class="d-flex justify-content-end align-items-center">
                <div class="font-size-14 font-rale">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="./register/indexr.php" class="btn custom-btn px-3 mx-1">Xin chào, <?php include('username.php');?></a>
                    <?php else: ?>
                        <a href="register/login.php" class="btn custom-btn px-3 mx-1">Đăng Nhập</a>
                        <a href="register/register.php" class="btn custom-btn px-3 mx-1">Đăng Ký</a>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </nav>
</header>
<script>
    $(document).ready(function(){
        const liveSearchResult = $('.live-search-result')

        $("#form-search input").keyup(function() {
            let keyword = $(this).val();
            if(keyword){
                liveSearch(keyword)
            } else {
                liveSearchResult.hide();
            }
        });

        function liveSearch(keyword){
            $.ajax({
                url: "database/check.php",
                type: "GET", 
                data: {
                    action: 'search-product',
                    keyword: keyword
                },
                dataType: "json",
                success: function(result){
                    const divSearchResult = $('.live-search-result .search-result');
                
                    let html = `<li style="padding: 8px 12px; font-weight: bold">Sản phẩm gợi ý</li>`

                    if(result.length > 0){
                        $.each(result, function(index, item){
                            html += `<div>
                                        <li>
                                            <a class="row" href="./product.php?item_id=${item['item_id']}">
                                                <div class="col col-xl-2">
                                                    <img src="${item['item_image']}">
                                                </div>
                                                <div class="col col-xl-10">
                                                    <span>${item["item_name"]}</span>
                                                </div>
                                            </a>
                                        </li>
                                    </div>`
                        })
                        liveSearchResult.show();
                    }
                    else{
                        html = '<li style="padding: 8px 12px; font-weight: bold">Không tìm thấy sản phẩm phù hợp</li>'
                        liveSearchResult.show();
                    }
                    divSearchResult.html(html)
                }
            })
        }
    })
</script>
<main id="main-site">