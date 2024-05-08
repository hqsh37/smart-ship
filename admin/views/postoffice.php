<?php
$postoffice = Postoffice::select();
$tt = 1;
?>

<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Quản lý bưu cục</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>TT</th>
                            <th>Mã bưu cục</th>
                            <th>Tên bưu cục</th>
                            <th>Số điện thoại</th>
                            <th>email</th>
                            <th>Địa chỉ chi tiết</th>
                            <th>Dịa chỉ</th>
                            <th>Cấp</th>
                            <th>Hành động</th>
                        </tr>
                        <?php foreach ($postoffice as $item) : ?>
                            <?php
                                $placeName = AddressUser::getNamePlace($item->ward);
                                $PlaceString = "{$placeName->wardName}, {$placeName->districtName}, {$placeName->provinceName}";
                            ?>
                        <tr>
                            <td><?php echo $tt++; ?></td>
                            <td><?php echo $item->maBuuCuc ?></td>
                            <td><?php echo $item->tenBuuCuc ?></td>
                            <td><?php echo $item->soDienThoai ?></td>
                            <td><?php echo $item->email ?></td>
                            <td><?php echo $item->diaChi ?></td>
                            <td><?php echo $PlaceString ?></td>
                            <td><?php echo $item->cap ?></td>
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