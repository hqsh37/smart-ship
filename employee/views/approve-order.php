<?php
$urlpath = $this->geturl("approve-order");
$managementUrl = $this->geturl("management-area");
$postOfficeId = $_SESSION["employee"]->idBuuCuc;
$area = Area::finds([
    "idBuuCuc" => $postOfficeId,
]);

if (!$area) {
    echo '<script>
    alert("Bưu cục cần có 1 khu vực để duyệt đơn hàng!");
    window.location.href = "'.$managementUrl.'";
    </script>';
    exit();
}

if (isset($_POST['btnApprove'])) {
    $idDonHang = $_POST['id'];
    $orderId = $_POST['orderId'];
    $userId = $_POST['userId'];

    $upOrder = Order::update([
        "idDonHang" => $idDonHang,
    ], [
        "idBuuCuc" => $postOfficeId,
        "trangThai" => "da-duyet",
    ]);

    if ($upOrder) {
        // create notification
        Notification::create([
            "idKH" => $userId,
            "trangThai" => "not-seen",
            "noiDung" => "Đơn hàng <strong>{$orderId}</strong> đã đươc duyệt.",
            "ngay" => date('Y-m-d H:i:s'),
        ]);
        echo '<script>
            alert("Duyệt thành công!");
            window.location.href = "'.$urlpath.'";
            </script>';
    } else {
        echo '<script>
            alert("Duyệt thất bại!")
            window.location.href = "'.$urlpath.'";
            </script>';
    }
}

if (isset($_POST['btnRefuse'])) {
    $idDonHang = $_POST['id'];
    $orderId = $_POST['orderId'];
    $userId = $_POST['userId'];

    $upOrder = Order::update([
        "idDonHang" => $idDonHang,
    ], [
        "idBuuCuc" => $postOfficeId,
        "trangThai" => "tu-choi",
    ]);

    if ($upOrder) {
        // create notification
        Notification::create([
            "idKH" => $userId,
            "trangThai" => "not-seen",
            "noiDung" => "Đơn hàng <strong>{$orderId}</strong> đã bị từ chối.",
            "ngay" => date('Y-m-d H:i:s'),
        ]);
        echo '<script>
            alert("Từ chối thành công!");
            window.location.href = "'.$urlpath.'";
            </script>';
    } else {
        echo '<script>
            alert("Từ chối thất bại!")
            window.location.href = "'.$urlpath.'";
            </script>';
    }
}

$areas = array();

foreach ($area as $item) {
    array_push($areas, $item->district);
}

$order = Order::finds([
    "idBuuCuc" => "0",
]);
$tt = 1;
?>

<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Duyệt đon hàng</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>TT</th>
                            <th>Mã đơn hàng</th>
                            <th>Tên đơn hàng</th>
                            <th>COD</th>
                            <th>khối lượng</th>
                            <th>Thời gian</th>
                            <th>Hành động</th>
                        </tr>
                        <?php foreach ($order as $item) : ?>
                        <?php
                        $infoSender = AddressSender::find([
                            "idTTNguoiGui" => $item->idTTNguoiGui,
                        ]);
                        $district = AddressOrder::find([
                            "idDiaChiDonHang" => $infoSender->idDiaChiDonHang,
                        ])->huyen;
                        $checkTransaction = Transaction::find([
                            "idGiaoDich" => $item->idGiaoDich,
                        ]);
                        ?>
                        <?php if (in_array($district, $areas) && $checkTransaction && $checkTransaction->tinhTrang === "da-duyet") : ?>
                        <?php
                        
                        $trangThai = "";
                        if ($item->trangThai === "cho-duyet") {
                            $trangThai = "Chờ duyệt";
                        } else if ($item->trangThai === "da-duyet") {
                            $trangThai = "Đang giao";
                        } else if ($item->trangThai === "thanh-cong") {
                            $trangThai = "Đã giao";
                        } else if ($item->trangThai === "tu-choi") {
                            $trangThai = "Từ chối";
                        }
                        $transaction = Transaction::find([
                            "idGiaoDich" => $item->idGiaoDich,
                        ]);
                        $ship = 0;
                        if($transaction) {
                            $ship = $transaction->soTien;
                        }
                        ?>
                        <tr>
                            <td><?php  echo $tt++; ?></td>
                            <td><?php  echo $item->maDonHang; ?></td>
                            <td><?php  echo $item->tenDonHang; ?></td>
                            <td><?php  echo $this->convertToVND($item->tienCod); ?></td>
                            <td><?php  echo $item->khoiluong; ?></td>
                            <td><?php  echo $this->convertDate($item->ngayGui); ?></td>
                            <td>
                                <button type="button" data-toggle="modal"
                                    data-target="#approve<?php echo $item->idDonHang ?>">
                                    Duyệt
                                </button>
                                <button type="button" data-toggle="modal"
                                    data-target="#refuse<?php echo $item->idDonHang ?>">
                                    từ chối
                                </button>
                                <button type="button" data-toggle="modal"
                                    data-target="#detail<?php echo $item->idDonHang; ?>">
                                    Chi tiết
                                </button>
                            </td>
                        </tr>
                        <!-- Modal xem chi tiết -->
                        <div class="modal fade" id="detail<?php echo $item->idDonHang; ?>" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Chi tiết đơn hàng</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $infoReceiver = AddressReceiver::find([
                                            "idTTNguoiNhan" => $item->idTTNguoiNhan,
                                        ]);
                                        $addressReceiver = AddressReceiver::findWithTbl("diachidonhang", [
                                            "idDiaChiDonHang" => $infoReceiver->idDiaChiDonHang,
                                        ]);
                                        $wardReceiver = Ward::find([
                                            "wards_id" => $addressReceiver->xa,
                                        ])->name;
                                        $districtReceiver = District::find([
                                            "district_id" => $addressReceiver->huyen,
                                        ])->name;
                                        $provinceReceiver = Province::find([
                                            "province_id" => $addressReceiver->tinh,
                                        ])->name;
                                        ?>
                                        <div>
                                            <h4 class="text-center">Thông tin người nhận</h4>
                                            <div class="sub-tt-hd">
                                                <p>Tên: <b><?php echo $infoReceiver->ten; ?></b></p>
                                                <p>Số điện thoại: <b><?php echo $infoReceiver->soDienThoai; ?></b></p>
                                                <p>Địa chỉ chi tiết: <b><?php echo $addressReceiver->chiTiet; ?></b></p>
                                                <p>Địa chỉ:
                                                    <b><?php echo $wardReceiver.", ".$districtReceiver.", ".$provinceReceiver; ?></b>
                                                </p>
                                            </div>
                                        </div>
                                        <?php
                                        $infoSender = AddressSender::find([
                                            "idTTNguoiGui" => $item->idTTNguoiGui,
                                        ]);
                                        $addressSender = AddressSender::findWithTbl("diachidonhang", [
                                            "idDiaChiDonHang" => $infoSender->idDiaChiDonHang,
                                        ]);
                                        $wardSender = Ward::find([
                                            "wards_id" => $addressSender->xa,
                                        ])->name;
                                        $districtSender = District::find([
                                            "district_id" => $addressSender->huyen,
                                        ])->name;
                                        $provinceSender = Province::find([
                                            "province_id" => $addressSender->tinh,
                                        ])->name;
                                        ?>
                                        <div>
                                            <h4 class="text-center">Thông tin người gửi</h4>
                                            <div class="sub-tt-hd">
                                                <p>Tên: <b><?php echo $infoSender->ten; ?></b></p>
                                                <p>Số điện thoại: <b><?php echo $infoSender->soDienThoai; ?></b></p>
                                                <p>Địa chỉ chi tiết: <b><?php echo $addressSender->chiTiet; ?></b></p>
                                                <p>Địa chỉ:
                                                    <b><?php echo $wardSender.", ".$districtSender.", ".$provinceSender; ?></b>
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="text-center">Thông tin đơn hàng</h4>
                                            <div class="sub-tt-hd">
                                                <p>Tên: <b><?php echo $item->tenDonHang; ?></b></p>
                                                <p>Khối lượng: <b><?php echo $item->khoiluong; ?></b></p>
                                                <p>Kích thước: <b><?php echo $item->kichThuoc; ?></b></p>
                                                <p>Loại đơn hàng: <b><?php echo $item->loaiDonHang; ?></b></p>
                                                <p>Ngày gửi: <b><?php echo $this->convertDate($item->ngayGui); ?></b>
                                                </p>
                                                <p>Trạng thái: <b><?php echo $trangThai; ?></b></p>
                                                <p>Dịch vụ gia tăng: <b><?php echo $item->dichvuGiaTang; ?></b></p>
                                                <p>Ghi chú: <b><?php echo $item->ghiChu; ?></b></p>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="text-center">Thanh toán</h4>
                                            <div class="sub-tt-hd">
                                                <p>Hình thức thanh toán:
                                                    <b><?php echo $transaction->phuongThucThanhToan; ?></b>
                                                </p>
                                                <p>Ship: <b><?php echo $this->convertToVND($ship); ?></b></p>
                                                <p>COD: <b><?php echo $this->convertToVND($item->tienCod); ?></b></p>
                                                <p>Trạng Thái: <b><?php echo $transaction->tinhTrang; ?></b></p>
                                                <p>Thời gian: <b><?php echo $transaction->thoiGian; ?></b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal approve Order with post office -->
                        <div class="modal fade" id="approve<?php echo $item->idDonHang ?>" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="<?php echo $urlpath ?>" method="POST">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Thông báo</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div style="display: none">
                                                <input name="id" value="<?php echo $item->idDonHang; ?>">
                                                <input name="orderId" value="<?php echo $item->maDonHang; ?>">
                                                <input name="userId" value="<?php echo $item->idKH; ?>">
                                            </div>
                                            <p>Bạn có chắc duyệt đơn này chứ!</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Đóng
                                            </button>
                                            <button type="submit" name="btnApprove" class="btn btn-default">
                                                Xác nhận
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal refuse Order with post office -->
                        <div class="modal fade" id="refuse<?php echo $item->idDonHang ?>" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="<?php echo $urlpath ?>" method="POST">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Thông báo</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div style="display: none">
                                                <input name="id" value="<?php echo $item->idDonHang; ?>">
                                                <input name="orderId" value="<?php echo $item->maDonHang; ?>">
                                                <input name="userId" value="<?php echo $item->idKH; ?>">
                                            </div>
                                            <p>Bạn có chắc từ chối đơn này chứ!</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Đóng
                                            </button>
                                            <button type="submit" name="btnRefuse" class="btn btn-default">
                                                Xác nhận
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</section>