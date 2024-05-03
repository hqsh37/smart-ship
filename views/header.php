<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $auth = true;
    
    $idkh = $user->idKH;
    $name = $user->hoTen;
    $birth = $user->sinhNhat;
    $gender = $user->gioiTinh;
    $phone = $user->soDienThoai;
    $email = $user->email;

} else {
    $auth = false;
}
?>

<header>
    <div class="top-header">
        <div class="container cus-top-header">
            <div class="contact">
                <p class="contact-item"> Call us now: <span> +(84)-328-435-442 </span> </p>
                <p class="mg-l8 contact-item"> Emai: <span> hqsh37@gmail.com </span> </p>
            </div>
            <div class="list-info">
                <a class="sub-list-info" href="#">SITEMAP</a>
                <a class="sub-list-info" href="#">PRIVACY</a>
                <a class="sub-list-info" href="#">HELP</a>
            </div>
        </div>
    </div>
    <div class="main-header">
        <div class="container cus-menu">
            <div class="logo">
                <img src="<?php echo $app->geturl("assets/img/logo.png"); ?>" alt="logo">
            </div>
            <ul id="nav">
                <li><a href="<?php echo $app->geturl("home") ?>">Trang chủ</a></li>
                <li><a href="<?php echo $app->geturl("orders-delivery") ?>">Quản lý đơn hàng</a></li>
                <li><a href="<?php echo $app->geturl("revenue") ?>">Quản lý doanh thu</a></li>
                <li><a href="<?php echo $app->geturl("tracking") ?>">Tiến trình ĐH</a></li>
                <li>
                    <a href="#">
                        Khác
                        <i class="icon-down ti-angle-down"></i>
                    </a>
                    <ul class="subnav">
                        <li><a href="#">doanh thu</a></li>
                        <li><a href="#">Extras</a></li>
                        <li><a href="#">Media</a></li>
                    </ul>
                </li>
            </ul>
            <div class="header-right">
                <div class="create-product">
                    <a class="btn-create-product" href="<?php echo $app->geturl("create-order") ?>"><span class="ti-plus"></span> Tạo đơn hàng</a>
                </div>
                <?php if ($auth) : ?>
                <div class="noti cus-tippy" id="noti-tippy-hov">
                    <div class="cus-noti">
                        <span id="noti-tippy" class="ti-bell"></span>
                        <div class="number-noti">8</div>
                    </div>
                    <div id="noti-body">
                        <div class="head-noti-tp">
                            <p>Thông báo</p>
                            <span class="ti-more"></span>
                        </div>
                        <div class="main-noti-tp">
                            <strong>Đào Như Thuần</strong> đã đăng một video trong <strong>Bộ tộc MixiGaming</strong>: Giọng hát truyền cảm cúm và cái kết :)).
                        </div>
                        <div class="main-noti-tp">
                            <strong>Đào Như Thuần</strong> đã đăng một video trong <strong>Bộ tộc MixiGaming</strong>: Giọng hát truyền cảm cúm và cái kết :)).
                        </div>
                        <div class="main-noti-tp">
                            <strong>Đào Như Thuần</strong> đã đăng một video trong <strong>Bộ tộc MixiGaming</strong>: Giọng hát truyền cảm cúm và cái kết :)).
                        </div>
                    </div>
                </div>
                <?php endif; ?> 
                <div class="login cus-tippy">
                    <?php if ($auth) : ?>
                    <div id="avt-tippy" class="img-avt d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Tài Khoản">
                        <img src="<?php echo $app->geturl("assets/img/avt.png"); ?>" alt="avt">
                    </div>
                    <div id="usr-body">
                        <div class="head-usr">
                            <div class="avt-more">
                                <img src="<?php echo $app->geturl("assets/img/avt.png"); ?>" alt="avatar">
                            </div>
                            <p><?php echo $name; ?></p>
                        </div>
                        <div class="sub-usr">
                            <span class="ti-map-alt"></span>
                            <a href="<?php echo $app->geturl("address-user") ?>" class="reset-a"><p>Quản lý địa chỉ</p></a>
                        </div>
                        <div class="sub-usr">
                            <span class="ti-settings"></span>
                            <a href="<?php echo $app->geturl("user-info") ?>" class="reset-a"><p>Cài đặt và hồ sơ cá nhân</p></a>
                        </div>
                        <div class="sub-usr">
                            <span class="ti-help"></span>
                            <p>Trợ giúp và hỗ trợ</p>
                        </div>
                        <div class="sub-usr">
                            <span class="ti-comments"></span>
                            <p>Đóng góp ý kiến</p>
                        </div>
                        <div class="sub-usr">
                            <span class="ti-shift-left"></span>
                            <a href="<?php echo $app->geturl("auth/logout.php") ?>" class="reset-a"><p>Đăng xuất</p></a>
                        </div>
                    </div>
                    <?php else : ?>
                        <a class="btn-login" href="<?php echo $app->geturl("auth/login.php")?>">LOGIN</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);
</script>