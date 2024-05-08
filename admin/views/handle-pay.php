<?php
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
                <h3 class="box-title">Bảng tính cước vận chuyển</h3>
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
                        <tr>
                            <td><?php echo $tt++?></td>
                            <td><?php echo $order->maDonHang ?></td>
                            <td><?php echo $item->soTien ?></td>
                            <td><?php echo $item->thoiGian ?></td>
                            <td><button>Duyệt</button></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</section>