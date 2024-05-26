<?php
$name = $_SESSION['delivery']->tenNhanVien;
$position = $_SESSION['delivery']->chucVu;
?>

<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p><?php echo $name; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">Điều hướng</li>
        <li>
            <a href="<?php echo $app->geturl("home"); ?>">
                <i class="fa fa-home"></i> <span>Trang chủ</span>
            </a>
        </li>
        <li>
            <a href="<?php echo $app->geturl("order-list"); ?>">
                <i class="fa fa-pencil"></i> <span>Quản lý đơn hàng</span>
            </a>
        </li>
        <li>
            <a href="<?php echo $app->geturl("approve-order"); ?>">
                <i class="fa fa-pencil"></i> <span>COD và đối soát</span>
            </a>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-search"></i>
                <span>Tra cứu</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $app->geturl("create-order"); ?>"><i class="fa fa-circle-o"></i> Tra cứu bưu cục</a></li>
                <li><a href="<?php echo $app->geturl("create-order"); ?>"><i class="fa fa-circle-o"></i> Ước tính cước phí</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-gear"></i>
                <span>Cài đặt tài khoản</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $app->geturl("create-order"); ?>"><i class="fa fa-circle-o"></i> Tài khoản</a></li>
                <li><a href="<?php echo $app->geturl("create-order"); ?>"><i class="fa fa-circle-o"></i> Đổi mật khẩu</a></li>
            </ul>
        </li>   
    </ul>
</section>