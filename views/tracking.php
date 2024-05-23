<?php
$checkOrder = "";
$checkSearch = false;
if(isset($_GET['orderId']) && $_GET['orderId']) {
    $orderId = $_GET['orderId'];
    $checkSearch = true;

    $checkOrder = Order::find([
        "maDonHang" => $orderId,
    ]);
    
    if ($checkOrder) {
        $postOfficeName = Postoffice::find([
            "idBuuCuc" => $checkOrder->idBuuCuc,
        ])->tenBuuCuc;

        $trangThai = "";
        if ($checkOrder->trangThai === "cho-duyet") {
            $trangThai = "Chờ duyệt";
        } else if ($checkOrder->trangThai === "da-duyet") {
            $trangThai = "Đang giao";
        } else if ($checkOrder->trangThai === "thanh-cong") {
            $trangThai = "Đã giao";
        } 
    }
}
?>

<div class="container cus-tientrinh">
    <center>
        <h2>Định vị đơn hàng</h2>
    </center>
    <div class="search-dh">
        <form class="d-flex" action="<?php echo $this->geturl("tracking") ?>" method="GET">
            <input class="form-control me-2" type="search" name="orderId"
                value="<?php echo $checkSearch ? $orderId : ""; ?>" placeholder="Nhập mã đơn hàng" aria-label="Search">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </form>
    </div>
    <?php if($checkOrder && $checkSearch) : ?>
    <div class="tt-dh">
        <h4>Thông tin đơn hàng</h4>
        <div class="sub-tt-hd">
            <p>Tên đơn hàng: <b><?php echo $checkOrder->tenDonHang ?></b></p>
        </div>
        <div class="sub-tt-hd">
            <p>Khối lượng(gram): <b><?php echo $checkOrder->khoiluong ?></b></p>
        </div>
        <div class="sub-tt-hd">
            <p>Bưu cục phát: <b><?php echo $postOfficeName ?></b></p>
        </div>
        <div class="sub-tt-hd">
            <p>Trạng thái: <b><?php echo $trangThai ?></b></p>
        </div>
    </div>
    <div class="tt-trangthai">
        <h4>Thông tin trạng thái</h4>
        <div class="sub-trangthai">
            <b>
                <p>18/4/2024 11:20</p>
                <p>Giao thành công (Người nhận wsh37)</p>
            </b>
        </div>
        <div class="sub-trangthai">
            <p>18/4/2024 11:20</p>
            <p>Hàng đang trên đường đến bạn (27 Vườn lài, Phường An Phú Đông, Q.12)</p>
        </div>
        <div class="sub-trangthai">
            <p>18/4/2024 11:20</p>
            <p>Hàng đang chuẩn bị giao</p>
        </div>
        <div class="sub-trangthai">
            <p>18/4/2024 11:20</p>
            <p>Đang phân lại đơn hàng</p>
        </div>
    </div>
    <?php elseif ($checkSearch) : ?>
    <div class="no-user">
        <h3>Mã đơn hàng này không tồn tại!</h3>
    </div>
    <?php else : ?>
    <div class="no-user">
    </div>
    <?php endif; ?>
</div>