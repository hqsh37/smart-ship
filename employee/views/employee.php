<?php

$idBuuCuc = $_SESSION['employee']->idBuuCuc;
$employee = Employee::finds([
    "idBuuCuc" => $idBuuCuc,
]);

$tt = 1;
?>

<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Quản lý user bưu cục</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>TT</th>
                            <th>Mã nhân viên</th>
                            <th>Tên</th>
                            <th>Chức vụ</th>
                            <th>email</th>
                            <th>Số điện thoại</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Hành động</th>
                        </tr>
                        <?php foreach ($employee as $item) : ?>
                        <tr>
                            <td><?php echo $tt++ ?></td>
                            <td><?php echo $item->maNhanVien ?></td>
                            <td><?php echo $item->tenNhanVien ?></td>
                            <td><?php echo $item->chucVu ?></td>
                            <td><?php echo $item->email ?></td>
                            <td><?php echo $item->soDienThoai ?></td>
                            <td><?php echo $item->ngaySinh ?></td>
                            <td><?php echo $item->gioiTinh ?></td>
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