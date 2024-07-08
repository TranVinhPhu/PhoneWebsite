<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LPKShop</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
    .pagination-container {
        display: flex;
        justify-content: center;
    }
    .pagination {
        text-align: center;
    }
    .pagination {
        text-align: center;
        padding: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .pagination a {
        display: inline-block;
        padding: 5px 10px;
        margin: 0 5px; 
        background-color: #f2f2f2;
        color: #333; 
        text-decoration: none;
        border-radius: 3px;
    }

    .pagination a:hover {
        background-color: #ddd;
    }

    .pagination .current {
        background-color: #007bff;
        color: #fff;
    }
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a href="index.php" class="logo">
      <span class="logo-mini"><b>L</b>PK</span>
      <span class="logo-lg"><b>LPK</b>Shop</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          
          <li class="dropdown user user-menu">
            <a href="" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../dist/img/avatar5.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Liêu Hoàng Long</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="../dist/img/avatar5.png" class="img-circle" alt="User Image">
                <p>
                  Liêu Hoàng Long - Developer
                  <small>Member since April. 2024</small>
                </p>
              </li>
              
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Thông Tin</a>
                </div>
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat">Đăng Xuất</a>
                </div>
              </li>
            </ul>
          </li>
        
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Liêu Hoàng Long</p>
          <a href=""><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Tìm kiếm...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
        <li class="treeview">
          <a href="#"><i class="fa fa-user" aria-hidden="true"></i> <span>Người dùng</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./create.php">Thêm người dùng</a></li>
            <li><a href="../Admin">Tất cả người dùng</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list" aria-hidden="true"></i>
            <span>Sản phẩm</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./createp.php">Thêm sản phẩm</a></li>
            <li><a href="./allp.php">Tất cả sản phẩm</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-usd" aria-hidden="true"></i><span>Hóa Đơn</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./allpay.php">Xử lý hóa đơn</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-usd" aria-hidden="true"></i><span>Thống Kê</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./thongke.php">Xem thống kê</a></li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Trang chủ
        <small>Chào mừng đến với trang chủ Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> LPKShop</a></li>
        <li class="active">Trang chủ</li>
      </ol>
    </section>
    <section class="content container-fluid">
      <?php echo $content; ?>
    </section>
  </div>
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="#">LPK Shop</a>.</strong> All rights reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>