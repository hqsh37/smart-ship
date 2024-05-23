<?php
$promotion = Promotion::select();
$tt = 1;
// print_r($promotion);
$path = $this->geturl("promotion");
// namePromotion: 5 tháng 5
// promotionId: 5THANG5
// discount: 30
// startAt: 2024-05-21
// endAt: 2024-05-30
// desc: chỉ dùng cho những ai nhận được thông báo 
// add: 
$alert = "";

// handlde add promotion
if(isset($_POST['add'])) {
    $namePromotion = $_POST['namePromotion'];
    $promotionId = $_POST['promotionId'];
    $discount = $_POST['discount'];
    $startAt = $_POST['startAt'];
    $endAt = $_POST['endAt'];
    $desc = $_POST['desc'];
    // `tenKhuyenMai`, `maKhuyenMai`, `phanTramGiam`, `ngayBatDau`, `ngayKetThuc`, `moTa`
    $checkPromotionId = Promotion::find([
        "maKhuyenMai" => $promotionId,
    ]);

    if($checkPromotionId) {
        $alert = "Mã khuyễn mãi này đã tồn tại!";
    } else {
        $result = Promotion::create([
            "tenKhuyenMai" => $namePromotion,
            "maKhuyenMai" => $promotionId,
            "phanTramGiam" => $discount,
            "ngayBatDau" => $startAt,
            "ngayKetThuc" => $endAt,
            "moTa" => $desc,
        ]);
        if($result) {
            $alert = "Thêm khuyến mãi thành công";
        } else {
            $alert = "Thêm khuyến mãi thất bại";
        }
    }
    
}

// handle Remove Promption
if(isset($_POST['btnRemove'])) {
    $id = $_POST['id'];

    $result = Promotion::delete([
        "idKhuyenMai" => $id,
    ]);
    if($result) {
        $alert = "Xóa khuyến mãi thành công";
    } else {
        $alert = "Xóa khuyến mãi thất bại";
    }
}
// handle Update Promotion
if(isset($_POST['btnUp'])) {
    $id = $_POST['id'];
    $namePromotion = $_POST['namePromotion'];
    $promotionId = $_POST['promotionId'];
    $promotionIdOld = $_POST['promotionIdOld'];
    $discount = $_POST['discount'];
    $startAt = $_POST['startAt'];
    $endAt = $_POST['endAt'];
    $desc = $_POST['desc'];
    
    $checkPromotionId;
    if($promotionIdOld !== $promotionId) {
        $checkPromotionId = Promotion::find([
            "maKhuyenMai" => $promotionId,
        ]);
    }
    
    if($checkPromotionId) {
        $alert = "Mã khuyễn mãi này đã tồn tại!";
    } else {
        $result = Promotion::update([
            "idKhuyenMai" => $id,
        ],[
            "tenKhuyenMai" => $namePromotion,
            "maKhuyenMai" => $promotionId,
            "phanTramGiam" => $discount,
            "ngayBatDau" => $startAt,
            "ngayKetThuc" => $endAt,
            "moTa" => $desc,
        ]);
        if($result) {
            $alert = "sửa khuyến mãi thành công";
        } else {
            $alert = "sửa khuyến mãi thất bại";
        }
    }
}
if($alert) {
    echo '<script>
        alert("'.$alert.'");
        window.location.href = "'.$path.'";
        </script>';
}

?>

<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Quản lý khuyến mãi</h3>
                <button type="button" class="btn btn-default pull-right" data-toggle="modal"
                    data-target="#addPromotion">
                    Thêm
                </button>
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
                            <th>Hành động</th>
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
                            <td>
                                <button type="button" class="btn btn-default" data-toggle="modal"
                                    data-target="#remove<?php echo $item->idKhuyenMai?>">
                                    Xoá
                                </button>
                                <button type="button" class="btn btn-default" data-toggle="modal"
                                    data-target="#update<?php echo $item->idKhuyenMai?>">
                                    Sửa
                                </button>
                            </td>
                        </tr>
                        <!-- modal Remove Promotion -->
                        <div class="modal fade" id="remove<?php echo $item->idKhuyenMai ?>" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="<?php echo $path ?>" method="POST">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Thông báo</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div style="display: none">
                                                <input name="id" value="<?php echo $item->idKhuyenMai; ?>">
                                            </div>
                                            <p>Bạn có chắc xoá mã khuyễn mãi này!</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Đóng</button>
                                            <button type="submit" name="btnRemove" class="btn btn-default">Xác
                                                nhận</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Add promotion -->
                        <div class="modal fade" id="update<?php echo $item->idKhuyenMai ?>" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="<?php echo $path ?>">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Sửa khuyến mâi</h4>
                                            <div style="display: none">
                                                <input name="id" value="<?php echo $item->idKhuyenMai; ?>">
                                                <input name="promotionIdOld" value="<?php echo $item->maKhuyenMai; ?>">
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12 mt-8">
                                                <label for="namePromotion"><b>Tên Khuyến mãi:</b></label>
                                                <input type="text" id="namePromotion" class="form-control"
                                                    placeholder="Nhập tên khuyến mãi" name="namePromotion" value="<?php echo $item->tenKhuyenMai; ?>" required>
                                            </div>
                                            <div class="col-md-12 mt-8">
                                                <label for="promotionId"><b>Mã khuyến mãi:</b></label>
                                                <input type="text" id="promotionId" class="form-control"
                                                    placeholder="Nhập mã khuyến mãi" name="promotionId"
                                                    pattern="[0-9 A-Z]+" minlength="5" value="<?php echo $item->maKhuyenMai; ?>" required>
                                                <small>Mã khuyến mãi phải là chữ viết hoa và số. Tối thiểu 5 ký
                                                    tự</small>
                                            </div>
                                            <div class="col-md-12 mt-8">
                                                <label for="discount"><b>Giảm(%):</b></label>
                                                <input type="text" id="discount" class="form-control"
                                                    placeholder="Nhập % giảm" name="discount" pattern="[0-9]+"
                                                    maxlength="2" value="<?php echo $item->phanTramGiam; ?>"  required>
                                                <small>Phải là số nguyên và lớn hơn 0 và nhỏ hơn 100</small>
                                            </div>
                                            <div class="col-md-12 mt-8">
                                                <label for="startAt"><b>Ngày bắt đầu:</b></label>
                                                <input type="date" class="form-control" id="startAt" name="startAt" value="<?php echo $item->ngayBatDau; ?>"
                                                    required>
                                            </div>
                                            <div class="col-md-12 mt-8">
                                                <label for="endAt"><b>Ngày kết thúc:</b></label>
                                                <input type="date" class="form-control" id="endAt" name="endAt" value="<?php echo $item->ngayKetThuc; ?>"
                                                    required>
                                            </div>
                                            <div class="col-md-12 mt-8">
                                                <label for="desc"><b>Mô tả:</b></label>
                                                <div class="input-group col-md-12">
                                                    <textarea style=" width: 100%; " name="desc" id="desc"
                                                        placeholder="Nhập mô tả"><?php echo $item->moTa; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Đóng</button>
                                            <button type="submit" name="btnUp" class="btn btn-default">Thêm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Add promotion -->
    <div class="modal fade" id="addPromotion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="<?php echo $path ?>">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Thêm khuyến mãi</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 mt-8">
                            <label for="namePromotion"><b>Tên Khuyến mãi:</b></label>
                            <input type="text" id="namePromotion" class="form-control" placeholder="Nhập tên khuyến mãi"
                                name="namePromotion" required>
                        </div>
                        <div class="col-md-12 mt-8">
                            <label for="promotionId"><b>Mã khuyến mãi:</b></label>
                            <input type="text" id="promotionId" class="form-control" placeholder="Nhập mã khuyến mãi"
                                name="promotionId" pattern="[0-9 A-Z]+" minlength="5" required>
                            <small>Mã khuyến mãi phải là chữ viết hoa và số. Tối thiểu 5 ký tự</small>
                        </div>
                        <div class="col-md-12 mt-8">
                            <label for="discount"><b>Giảm(%):</b></label>
                            <input type="text" id="discount" class="form-control" placeholder="Nhập % giảm"
                                name="discount" pattern="[0-9]+" maxlength="2" required>
                            <small>Phải là số nguyên và lớn hơn 0 và nhỏ hơn 100</small>
                        </div>
                        <div class="col-md-12 mt-8">
                            <label for="startAt"><b>Ngày bắt đầu:</b></label>
                            <input type="date" class="form-control" id="startAt" name="startAt" required>
                        </div>
                        <div class="col-md-12 mt-8">
                            <label for="endAt"><b>Ngày kết thúc:</b></label>
                            <input type="date" class="form-control" id="endAt" name="endAt" required>
                        </div>
                        <div class="col-md-12 mt-8">
                            <label for="desc"><b>Mô tả:</b></label>
                            <div class="input-group col-md-12">
                                <textarea style=" width: 100%; " name="desc" id="desc"
                                    placeholder="Nhập mô tả"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button type="submit" name="add" class="btn btn-default">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>