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

    $upOrder = Order::update([
        "idDonHang" => $idDonHang,
    ], [
        "idBuuCuc" => $postOfficeId,
        "trangThai" => "da-duyet",
    ]);

    if ($upOrder) {
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

    $upOrder = Order::update([
        "idDonHang" => $idDonHang,
    ], [
        "idBuuCuc" => $postOfficeId,
        "trangThai" => "da-duyet",
    ]);

    if ($upTransaction) {
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
                <h3 class="box-title">Bảng tính cước vận chuyển</h3>
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
                        <?php if (in_array($district, $areas) && $checkTransaction->tinhTrang === "da-duyet") : ?>
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
                                <button>Xem chi tiết</button>
                            </td>
                        </tr>
                        <!-- Modal approve Order with post office -->
                        <div class="modal fade" id="approve<?php echo $item->idDonHang ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                            </div>
                                            <p>Bạn có chắc duyệt đơn này chứ!</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-default"
                                                data-dismiss="modal"
                                            >
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
                        <div class="modal fade" id="refuse<?php echo $item->idDonHang ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                            </div>
                                            <p>Bạn có chắc từ chối đơn này chứ!</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-default"
                                                data-dismiss="modal"
                                            >
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