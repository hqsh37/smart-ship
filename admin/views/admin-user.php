<?php
$employee = Admin::select();

$tt = 1;
?>

<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Quản lý user quản trị viên</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>TT</th>
                            <th>Mã admin</th>
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
                            <!-- `id`, `adminId`, `name`, `phone`, `email`, `position`, `password`, `birth`, `gender` -->
                            <td><?php echo $tt++ ?></td>
                            <td><?php echo $item->adminId ?></td>
                            <td><?php echo $item->name ?></td>
                            <td><?php echo $item->position ?></td>
                            <td><?php echo $item->email ?></td>
                            <td><?php echo $item->phone ?></td>
                            <td><?php echo $item->birth ?></td>
                            <td><?php echo $item->gender ?></td>
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