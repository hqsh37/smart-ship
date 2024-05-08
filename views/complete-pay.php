<?php
// hinhthucPay: transfer
// codPay: cod-all
// cod-cash: 0
// sumCash: 0
// idDH: 49
// tongTien: 8610
// btnPayOrder: 
if (isset($_POST['btncomplete'])) {
    echo '
    <script>
        alert("Đon hàng đã xong! \nCảm ơn bạn đã sử dụng dịch vụ SmartShip!");
        window.location.href = "<?php echo $this->geturl("orders-delivery"); ?>";
    </script>';

}

if (isset($_POST['btnPayOrder'])) {
    $hinhthucPay = $_POST['hinhthucPay'];
    $codPay = $_POST['codPay'];
    $codCash = $_POST['cod-cash'];
    $sumCash = $_POST['sumCash'];
    $idDH = $_POST['idDH'];
    $tongTien = $_POST['tongTien'];

    $error = "";
    $sumCash = 0;

    if (isset($_POST['sumCash']) && $_POST['sumCash'] > 0) {
        $sumCash = $_POST['sumCash'];
    }

    if($hinhthucPay === "transfer") {
        $sumCash = 0;
    }
    
    $transfer = TransferInfo::select();

    $transfer = $transfer[0];

    $resultDH = Order::find([
        "idDonHang" => $idDH,
    ]);

    if(!$resultDH) {
        $error = "Đơn hàng không tồn tại!";
    }

    // `idGiaoDich`, `idDonHang`, `idNhanVien`, `loaiGiaoDich`, `soTien`, `phuongThucThanhToan`, `tinhTrang`, `thoiGian`
    $transactionId = Transaction::createMoreTbl([
        "idDonHang" => $idDH,
        "loaiGiaoDich" => "don-hang",
        "idNhanVien" => 0,
        "soTien" => $tongTien,
        "phuongThucThanhToan" => $hinhthucPay,
        "tinhTrang" => "cho-duyet",
        "thoiGian" => date('Y-m-d H:i:s'),
    ], "giaodich");


    if($transactionId) {
        Order::update([
            "idDonHang" => $idDH,
        ], [
            "idGiaoDich" => $transactionId,
            "tienCod" => $sumCash,
        ]);

    } else {
        $error = "Có lỗi xảy ra!";
    }

}
// 
?>

<div class="container main">
    <div class="header-complete">
        <h2>
            Hoàn tất thanh toán
        </h2>
    </div>
    <div>
        <?php if($hinhthucPay === "transfer" || ($codPay === "cod-transfer" && $hinhthucPay === "cod")) : ?>
        <form method="POST">
            <h4 class="text-center">Thông tin chuyển khoản</h4>
            <div class="sub-tt-hd">
                <p>Tên ngân hàng: <b><?php echo $transfer->tenNganHang; ?></b></p>
            </div>
            <div class="sub-tt-hd">
                <p>số tài khoản: <b><?php echo $transfer->SoTK; ?></b></p>
            </div>
            <div class="sub-tt-hd">
                <p>Tên: <b><?php echo $transfer->ten; ?></b></p>
            </div>
            <div class="sub-tt-hd">
                <p>Tổng tiền: <b><?php echo $this->convertToVND($tongTien); ?></b></p>
            </div>
            <div class="sub-tt-hd">
                <p>Nội dung chuyển khoản: <b><?php echo $resultDH->maDonHang; ?></b></p>
            </div>
            <h4 class="text-center">Mã QR chuyển khoản ngân hàng</h4>
            <div class="img-qr">
                <img
                    src="https://qr.sepay.vn/img?acc=<?php echo $transfer->SoTK; ?>&bank=<?php echo $transfer->tenNganHang; ?>&amount=<?php echo $tongTien?>&des=<?php echo $resultDH->maDonHang; ?>" />
            </div>
            <p>Nếu đã chuyển xong bấm hoàn tất đơn hàng bên dưới!</p>
            <div class="d-flex justify-content-center align-items-center">
                <button class="btn-lg" name="btncomplete">Hoàn tất đơn hàng</button>
            </div>
        </form>
        <?php else :?>
            <script>
                alert("Đon hàng đã xong! \nCảm ơn bạn đã sử dụng dịch vụ SmartShip!");
                window.location.href = "<?php echo $this->geturl("orders-delivery"); ?>";
            </script>
        <?php endif; ?>

    </div>

</div>