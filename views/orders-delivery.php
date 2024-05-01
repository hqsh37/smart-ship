<?php
$orders = Order::select();
$tt = 1;
?>

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
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mã ĐH</th>
                    <th scope="col">Tên đơn hàng</th>
                    <th scope="col">ship</th>
                    <th scope="col">COD</th>
                    <th scope="col">Ngày Gửi</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Chi tiết</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($orders as $order) : ?>    
                <tr>
                    <th><?php echo $tt++; ?></th>
                    <th><?php echo $order->maDonHang; ?></th>
                    <th><?php echo $order->tenDonHang; ?></th>
                    <th>30.000đ</th>
                    <th>30.000đ</th>
                    <th><?php echo $order->ngayGui; ?></th>
                    <th><?php echo $order->trangThai; ?></th>
                    <th><a href="#">Xem chi tiết</a></th>
                </tr>
        <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>