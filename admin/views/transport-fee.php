<?php
$transport = TransportFee::select();
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
                            <th>Nấc khối lượng</th>
                            <th>Giá cùng tỉnh</th>
                            <th>Giá khác tỉnh</th>
                            <th>Hành động</th>
                        </tr>
                        <?php foreach ($transport as $item) : ?>
                        <tr>
                            <td><?php echo $item->nacKhoiLuong ?></td>
                            <td><?php echo $item->giaCungTinh ?></td>
                            <td><?php echo $item->giaCachTinh ?></td>
                            <td>sửa</td>
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