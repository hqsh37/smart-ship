<div class="container cus-qldh">
    <nav class="nav-dh">
        <ul>
            <li class="sub-dh">
                <a href="?v=all">Tất cả đơn hàng</a>
            </li>
            <li class="sub-dh">
                <a href="?v=dang-giao">Đơn hàng đang giao</a>
            </li>
            <li class="sub-dh">
                <a href="?v=xu-ly">Đơn chờ xử lý</a>
            </li>
            <li class="sub-dh">
                <a href="?v=da-giao">Đơn hàng đã giao</a>
            </li>
        </ul>
    </nav>
    <div class="content-dh">
        <?php
        $vdh = isset($_GET['v']) ? $_GET['v'] : '/';
        switch($vdh) {
            case 'all':
                include 'qlDH/allDH.php';
                break;
            case 'dang-giao':
                include 'qlDH/danggiao.php';
                break;
            case 'xu-ly':
                include 'qlDH/danggiao.php';
                break;
            case 'da-giao':
                include 'qlDH/danggiao.php';
                break;
            default:
                include "qlDH/allDH.php";
                break;

        }
        ?>
    </div>
</div>