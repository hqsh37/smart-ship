<?php
$user = User::select();

$tt = 1;
?>

<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Quản lý user bưu cục</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>TT</th>
                            <th>Tên</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>email</th>
                            <th>Số điện thoại</th>
                            <th>Hành động</th>
                        </tr>
                        <?php foreach ($user as $item) : ?>
                        <tr>
                            <td><?php echo $tt++ ?></td>
                            <td><?php echo $item->hoTen ?></td>
                            <td><?php echo $this->convertDate($item->sinhNhat) ?></td>
                            <td><?php echo $item->gioiTinh ?></td>
                            <td><?php echo $item->email ?></td>
                            <td><?php echo $item->soDienThoai ?></td>
                            <td>xem chi tiết</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>