<?php
$promotion = Promotion::select();
$tt = 1;
?>

<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Quản lý khuyến mãi</h3>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>TT</th>
                        <th>Tên</th>
                        <th>Mã khuyến mãi</th>
                        <th>Giảm</th>
                        <th>Bắt đầu</th>
                        <th>Kết thúc</th>
                        <th>Mô tả</th>
                    </tr>
                    <?php foreach($promotion as $item) : ?>
                    <tr>
                        <td><?php echo $tt++; ?></td>
                        <td><?php echo $item->tenKhuyenMai; ?></td>
                        <td><?php echo $item->maKhuyenMai; ?></td>
                        <td><?php echo $item->phanTramGiam; ?>%</td>
                        <td><?php echo $item->ngayBatDau; ?></td>
                        <td><?php echo $item->ngayKetThuc; ?></td>
                        <td><?php echo $item->moTa; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>