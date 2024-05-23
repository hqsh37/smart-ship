<?php
$urlpath = $this->geturl("handle-pay");

if (isset($_POST['btnApprove'])) {
    $idGiaoDich = $_POST['idGiaoDich'];
    $orderId = $_POST['orderId'];
    $userId = $_POST['userId'];

    $upTransaction = Transaction::update([
        "idGiaoDich" => $idGiaoDich,
    ], [
        "tinhTrang" => "da-duyet",
        "thoiGian" => date("Y-m-d H:i:s"),
    ]);

    if ($upTransaction) {
        // create notification
        Notification::create([
            "idKH" => $userId,
            "trangThai" => "not-seen",
            "noiDung" => "Đơn hàng <strong>{$orderId}</strong> thanh toán thành công.",
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
    $idGiaoDich = $_POST['idGiaoDich'];
    $orderId = $_POST['orderId'];
    $userId = $_POST['userId'];

    $upTransaction = Transaction::update([
        "idGiaoDich" => $idGiaoDich,
    ], [
        "tinhTrang" => "tu-choi",
        "thoiGian" => date("Y-m-d H:i:s"),
    ]);

    if ($upTransaction) {
        // create notification
        Notification::create([
            "idKH" => $userId,
            "trangThai" => "not-seen",
            "noiDung" => "Đơn hàng <strong>{$orderId}</strong> bị huỷ do quá hạn thanh toán.",
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

$transaction = Transaction::finds([
    "tinhTrang" => "cho-duyet",
    "phuongThucThanhToan" => "transfer",
]);
$tt = 1;
?>

<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Duyệt chuyển khoản</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>TT</th>
                            <th>Mã đơn hàng</th>
                            <th>Số tiền</th>
                            <th>Thời gian</th>
                            <th>Hành động</th>
                        </tr>
                        <?php foreach ($transaction as $item) : ?>
                        <?php 
                        $order = Order::find([
                            "idDonHang" => $item->idDonHang,
                        ]);    
                        ?>
                        <?php if ($order) : ?>
                        <tr>
                            <td><?php echo $tt++?></td>
                            <td><?php echo $order->maDonHang ?></td>
                            <td><?php echo $item->soTien ?></td>
                            <td><?php echo $item->thoiGian ?></td>
                            <td>
                                <button type="button" data-toggle="modal"
                                    data-target="#refuse<?php echo $order->idDonHang?>">
                                    Từ chối
                                </button>
                                <button type="button" data-toggle="modal"
                                    data-target="#approve<?php echo $order->idDonHang?>">
                                    Duyệt
                                </button>
                            </td>
                        </tr>
                        <!-- Modal approve -->
                        <div class="modal fade" id="approve<?php echo $order->idDonHang?>" tabindex="-1" role="dialog"
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
                                                <input type="text" name="idGiaoDich" value="<?php echo $item->idGiaoDich ?>">
                                                <input name="orderId" value="<?php echo $order->maDonHang; ?>">
                                                <input name="userId" value="<?php echo $order->idKH; ?>">
                                            </div>
                                            <p>Bạn có chắc duyệt đơn hàng này!</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Đóng</button>
                                            <button type="submit" name="btnApprove" class="btn btn-default">Xác nhận</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal refuse -->
                        <div class="modal fade" id="refuse<?php echo $order->idDonHang?>" tabindex="-1" role="dialog"
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
                                                <input type="text" name="idGiaoDich" value="<?php echo $item->idGiaoDich ?>">
                                                <input name="orderId" value="<?php echo $order->maDonHang; ?>">
                                                <input name="userId" value="<?php echo $order->idKH; ?>">
                                            </div>
                                            <p>Bạn có chắc từ chối đơn hàng này!</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Đóng</button>
                                            <button type="submit" name="btnRefuse" class="btn btn-default">Xác nhận</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</section>