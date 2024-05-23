<?php
if (!isset($_SESSION['product']) && !isset($_POST['createOrder'])) {
    echo '<script>
    window.location.href = "'.$this->geturl("create-order").'";
    </script>';
    die();
}

$alert = "";
$promotion = "";

if (isset($_POST['createOrder'])) {
    $user = $_SESSION['user'];
    $idKH = $user->idKH;

    $receiverName = $_POST['receiverName'];
    $receiverPhone = $_POST['receiverPhone'];
    $receiverPlace = $_POST['receiverPlace'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $wards = $_POST['wards'];
    $layhang = $_POST['layhang'];
    $diachiTannoi = $_POST['diachiTannoi'];
    $productName = $_POST['productName'];
    $khoiluong = $_POST['khoiluong'];
    $soluong = $_POST['soluong'];
    $tongKl = $_POST['tongKl'];

    if ($tongKl === "Vui lòng nhập khối lượng!") {
        $tongKl = $khoiluong*$soluong."g";
    }

    
    $_SESSION['product']['tongKl'] = $tongKl;
    $_SESSION['product']['productName'] = $productName;


        
    // lấy thông tin địa chỉ người nhận
    $resultAddressUsr = AddressUser::find([
        "idDiaChiKH" => $diachiTannoi,
    ]);

    // Tính phí vận chuyển
    $transports = TransportFee::select();
    $tongKhoiluong = $khoiluong*$soluong/1000;
    $tongTien = 0;
    foreach ($transports as $transport) {
        if($tongKhoiluong < $transport->nacNumber) {
            if($province === $resultAddressUsr->province) {
                $result_cash = $tongKhoiluong * $transport->giaCungTinh;
            } else {
                $result_cash = $tongKhoiluong * $transport->giaCachTinh;
            }
            if($tongTien < $result_cash) {
                $tongTien = $result_cash;
            }
        }
    }
    $_SESSION['product']['tongTien'] = $tongTien;
} else {
    if (isset($_SESSION['product'])) {
        $tongTien = $_SESSION['product']['tongTien'];    
        $resultOrder = $_SESSION['product']['resultOrder'];
        $productName = $_SESSION['product']['productName'];
        $tongKl = $_SESSION['product']['tongKl'];

        if(isset($_POST['promotion'])) {
            $promotion = $_POST['promotion'];

            $checkPromotion = Promotion::find([
                "maKhuyenMai" => $promotion,
            ]);

            if ($checkPromotion) {
                $discount = $checkPromotion->phanTramGiam;
                $tongTien = $tongTien - ($tongTien*$discount/100);
                echo '<script>
                alert("Bạn được giảm '.$discount.'% phí vận chuyển cho đơn hàng trên");
                </script>';
            } else {
                echo '<script>
                alert("Mã khuyến mãi không tồn tại!");
                </script>';
            }

            
        }
    }

}

// SELECT `idDiaChiDonHang`, `tinh`, `huyen`, `xa`, `chiTiet` FROM `diachidonhang` WHERE 1
if(isset($_POST['createOrder']) && $_SESSION['func']['order'] === 'createOrder') {
    $_SESSION['func']['order'] = 'payOrder';

    $currentDate = date('Y-m-d');
    $dichvuString = "";
    $kichThuoc = "";
    $loaiDH = "";
    if (isset($_POST['chieuDai']) && isset($_POST['chieuRong']) && isset($_POST['chieuCao'])) {
        $chieuDai = $_POST['chieuDai'];
        $chieuRong = $_POST['chieuRong'];
        $chieuCao = $_POST['chieuCao'];
        $kichThuoc = $chieuDai."x".$chieuRong."x".$chieuCao;
    }

    if (isset($_POST['dichvuGT'])) {
        $dichvuGT = $_POST['dichvuGT'];
        foreach($dichvuGT as $dichvu) {
            $dichvuString = $dichvuString.$dichvu.", ";
        }

    }

    if (isset($_POST['loaiDH'])) {
        $loaiDH = $_POST['loaiDH'];
    }


    if($layhang === "tannoi") {
        // Insert address Receiver
        $addressReceiverId = AddressReceiver::createMoreTbl([
            "tinh" => $province,
            "huyen" => $district,
            "xa" => $wards,
            "chiTiet" => $receiverPlace,
        ], "diachidonhang");
        if(!$addressReceiverId) {
            $alert = "Không thể tạo địa chỉ người nhận";
        }
        // `idTTNguoiNhan`, `idDiaChiDonHang`, `ten`, `soDienThoai`, `dienGiai`
        $resultAddAddressReceiver = AddressReceiver::createMoreTbl([
            "idDiaChiDonHang" => $addressReceiverId,
            "ten" => $receiverName,
            "soDienThoai" => $receiverPhone,
            "dienGiai" => "",
        ], "thongtinnguoinhan");
        if (!$resultAddAddressReceiver) {
            $alert = "Không thể tạo thông tin người nhận";
        }

        // Insert address Sender
        $addressSenderId = AddressSender::createMoreTbl([
            "tinh" => $resultAddressUsr->province,
            "huyen" => $resultAddressUsr->district,
            "xa" => $resultAddressUsr->wards,
            "chiTiet" => $resultAddressUsr->address,
        ], "diachidonhang");
        if(!$addressSenderId) {
            $alert = "Không thể tạo địa chỉ người gửi";
        }

        $resultAddAddressSender = AddressSender::createMoreTbl([
            "idDiaChiDonHang" => $addressSenderId,
            "ten" => $resultAddressUsr->tenKH,
            "soDienThoai" => $resultAddressUsr->phone,
            "dienGiai" => "",
        ], "thongtinnguoigui");
        if (!$resultAddAddressSender) {
            $alert = "Không thể tạo thông tin người gửi";
        }

        // Insert product
        if(!$alert) {
            $resultOrder = Order::createMoreTbl([
                "idKH" => $idKH,
                "idDonHuy" => 0,
                "idNhapKho" => 0,
                "idBuuCuc" => 0,
                "idTTNguoiNhan" => $resultAddAddressReceiver,
                "idTTNguoiGui" => $resultAddAddressSender,
                "maDonHang" => $this->generateId(10),
                "tenDonHang" => $productName,
                "hinhThucGuiHang" => $layhang,
                "ngayGui" => $currentDate,
                "trangThai" => "cho-duyet",
                "hinhThucGiao" => "kh-bc",
                "khoiluong" => $tongKl,
                "kichThuoc" => $kichThuoc,
                "loaiDonHang" => $loaiDH,
                "dichvuGiaTang" => $dichvuString,
                "ghiChu" => "",
            ], "donhang");
            $_SESSION['product']['resultOrder'] = $resultOrder;
        }
    } else {
        $alert = "Vui lòng gửi trực tiếp với bưu cục để có thể tạo đơn này!";
    }
    
    if($alert && $resultOrder) {
        echo '<script>
            alert("'.$alert.'");
            window.location.href = "'.$this->geturl("create-order").'";
            </script>';
    }

     
}

// Insert address Receiver

// Insert address Sender    

// Insert product

// Create transaction
?>

<div class="container main">
    <div class="header-pay">
        <h2>
            Thanh toán
        </h2>
    </div>
    <div class="main-pay">
        <div>
            <h4 class="text-center">Hình thức thanh toán</h4>
            <div class="sub-tt-hd">
                <p>Tên đơn hàng: <b><?php echo $productName; ?></b></p>
            </div>
            <div class="sub-tt-hd">
                <p>Khối lượng: <b><?php echo $tongKl; ?></b></p>
            </div>
            <div class="sub-tt-hd">
                <p>Tiền công thêm: <b>0đ</b></p>
            </div>
            <div class="sub-tt-hd">
                <p>Tổng tiền: <b><?php echo $this->convertToVND($tongTien); ?></b></p>
            </div>
        </div>
    </div>
    <div class="main-pay">
        <h4 class="text-center">Mã khuyến mãi</h4>
        <form action="<?php echo $this->geturl("pay-order")?>" method="POST">
            <div class="cus-subpay">
                <input class="form-control mr-sm-2" type="text" name="promotion" placeholder="Nhập mã khuyễn mãi" value="<?php echo $promotion?>">
                <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Áp dụng</button>
            </div>
        </form>
    </div>
    <div class="main-pay">
        <form method="POST" action="<?php echo $this->geturl("complete-pay") ?>">
            <h4 class="text-center">Hình thức thanh toán</h4>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="hinhthucPay" id="transfer" value="transfer" checked>
                <label class="form-check-label" for="transfer">
                    Thanh toán chuyển khoản
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="hinhthucPay" id="cash" value="cash">
                <label class="form-check-label" for="cash">
                    Thanh toán tiền mặt
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="hinhthucPay" id="cod" value="cod">
                <label class="form-check-label" for="cod">
                    gửi hàng COD
                </label>
                <select class="form-control" id="cod-pay" name="codPay">
                    <option value="cod-all">Người nhận thanh toán!</option>
                    <option value="cod-transfer">chỉ thanh toán tiền ship(chuyển khoản)</option>
                    <option value="cod-cash">chỉ thanh toán tiền ship(tiền mặt)</option>
                </select>
                <div class="form-group">
                    <label for="num-cash">Số tiền thu hộ</label>
                    <input type="number" class="form-control" id="num-cash" name="cod-cash" value="0"
                        placeholder="Nhập số tiền thu hộ!">
                    <small>Số tiền thu hộ sẽ bị tính thêm 1%</small>
                </div>
                <div class="form-group">
                    <label for="txt-sumCash">Tổng tiền code</label>
                    <input type="text" class="form-control" id="txt-sumCash" name="sumCash" value="0"
                        placeholder="Vui lòng số tiền thu hộ!" readonly required>
                </div>
                <br />
                <br />
                <div style="display: none;">
                    <input name="idDH" value="<?php echo $resultOrder?>">
                    <input name="tongTien" value="<?php echo $tongTien?>">
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn-lg" name="btnPayOrder">Hoàn tất đơn hàng</button>
                </div>
            </div>
        </form>
    </div>

    <script>
    const codEl = document.getElementById("cod-pay");
    const cashEl = document.getElementById("num-cash");
    const sumCashEl = document.getElementById("txt-sumCash");
    const codParentEl = document.getElementById("cod");
    var transportCash = <?php echo ($tongTien) ? $tongTien : 0; ?>;
    cashEl.addEventListener("input", function() {
        if (cashEl.value === 0 || cashEl.value === '') {
            sumCashEl.value = 0;
        } else if (codEl.value === "cod-all") {
            sumCashEl.value = Math.round(parseInt(cashEl.value) * 1.01 + transportCash);
        } else {
            sumCashEl.value = Math.round(parseInt(cashEl.value) * 1.01);
        }
    });

    codEl.addEventListener("change", function() {
        if (cashEl.value === '') {
            sumCashEl.value = 0;
        } else if (codEl.value === "cod-all") {
            sumCashEl.value = Math.round(parseInt(cashEl.value) * 1.01 + transportCash);
        } else {
            sumCashEl.value = Math.round(parseInt(cashEl.value) * 1.01);
        }
    });

    codParentEl.addEventListener("click", function() {
        if (cashEl.value === '') {
            sumCashEl.value = 0;
        } else if (codEl.value === "cod-all") {
            sumCashEl.value = Math.round(parseInt(cashEl.value) * 1.01 + transportCash);
        } else {
            sumCashEl.value = Math.round(parseInt(cashEl.value) * 1.01);
        }
    });
    </script>
</div>

<?php

?>