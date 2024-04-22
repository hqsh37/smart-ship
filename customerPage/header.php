<?php
$path = isset($_GET['page1']) ? '.' : ''; 
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
                <img src="<?php echo $path; ?>./assets/img/logo.png" alt="logo">
            </div>
            <ul id="nav">
                <li><a href="/smartShip/home">Trang chủ</a></li>
                <li><a href="/smartShip/qlDH">Quản lý đơn hàng</a></li>
                <li><a href="/smartShip/qlDT">Quản lý doanh thu</a></li>
                <li><a href="/smartShip/tien-trinh">Tiến trình ĐH</a></li>
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
                    <a class="btn-create-product" href="createDH"><span class="ti-plus"></span> Tạo đơn hàng</a>
                </div>
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
                <div class="login cus-tippy">
                    <!-- <a class="btn-login" href="#">LOGIN</a> -->
                    <div id="avt-tippy" class="img-avt d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Tài Khoản">
                        <img src="<?php echo $path; ?>./assets/img/avt.png" alt="avt">
                    </div>
                    <div id="usr-body">
                        <div class="head-usr">
                            <div class="avt-more">
                                <img src="<?php echo $path; ?>./assets/img/avt.png" alt="avatar">
                            </div>
                            <p>Hoàng Quang Sang</p>
                        </div>
                        <div class="sub-usr">
                            <span class="ti-map-alt"></span>
                            <a href="/smartShip/address" class="reset-a"><p>Quản lý địa chỉ</p></a>
                        </div>
                        <div class="sub-usr">
                            <span class="ti-settings"></span>
                            <a href="/smartShip/userInfo" class="reset-a"><p>Cài đặt và hồ sơ cá nhân</p></a>
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
                            <span class="ti-arrowh-circle-right"></span>
                            <p>Đăng xuất</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>