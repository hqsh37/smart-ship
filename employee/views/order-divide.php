<?php
$postoffice = $_SESSION['employee']->idBuuCuc;
// `idDonHang`, `thoiGian`, `loaiVanChuyen`, `trangThai`, `diaChi`, `moTa`
// handle delivery for Post Office
if (isset($_POST['btnPostoffice'])) {
    $id = $_POST['postofficeId'];
    $orderId = $_POST['orderId'];
    $address = $_POST['address'];

    // create Delivery
    $checkDelivery = Delivery::createMoreTbl([
        "idDonHang" => $orderId,
        "thoiGian" => date("Y-m-d H:i:s"),
        "loaiVanChuyen" => "bc-bc",
        "trangThai" => "cho-duyet",
        "diaChi" => $address,
    ]);

    // Upadte Order Vanchuyen

}

// handle delivery for Shipper
if (isset($_POST['btnShipper'])) {
    $id = $_POST['shipper'];

    // create Delivery
    $checkDelivery = Delivery::createMoreTbl();

    // Upadte Order Vanchuyen
}



$productsPerPage = 15;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$category = isset($_GET['v']) ? $_GET['v'] : "";
$offset = ($currentPage - 1) * $productsPerPage;
$total= 0;
$rules = [
    "idBuuCuc" => $postoffice,
    "hinhThucGiao" => "kh-bc"
];

$ordersTotal = Order::find($rules, "COUNT(`donhang`.`idDonHang`) as 'total'");
if ($ordersTotal) {
    $total = $ordersTotal->total;
}
$totalPages = ceil($total / $productsPerPage);
$orders = Order::findShow($rules, "*", $productsPerPage, $offset);

$tt = 1;

$shippers = Employee::finds([
    "idBuuCuc" => $postoffice,
    "chucVu" => "shipper"
]);
?>
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Quản lý đơn hàng</h3>
        </div>
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
                        <th>Địa chỉ giao</th>
                        <th>Hành động</th>
                    </tr>
                    <?php foreach ($orders as $item) : ?>
                    <?php
                    
                    $trangThai = "";
                    if ($item->trangThai === "cho-duyet") {
                        $trangThai = "Chờ duyệt";
                    } else if ($item->trangThai === "da-duyet") {
                        $trangThai = "Đang giao";
                    } else if ($item->trangThai === "thanh-cong") {
                        $trangThai = "Đã giao";
                    } else if ($item->trangThai === "tu-choi") {
                        $trangThai = "Từ chối";
                    }
                    $transaction = Transaction::find([
                        "idGiaoDich" => $item->idGiaoDich,
                    ]);
                    $ship = 0;
                    if($transaction) {
                        $ship = $transaction->soTien;
                    }
                    
                    $infoReceiver = AddressReceiver::find([
                        "idTTNguoiNhan" => $item->idTTNguoiNhan,
                    ]);
                    $addressReceiver = AddressReceiver::findWithTbl("diachidonhang", [
                        "idDiaChiDonHang" => $infoReceiver->idDiaChiDonHang,
                    ]);
                    $wardReceiver = Ward::find([
                        "wards_id" => $addressReceiver->xa,
                    ])->name;
                    $districtReceiver = District::find([
                        "district_id" => $addressReceiver->huyen,
                    ])->name;
                    $provinceReceiver = Province::find([
                        "province_id" => $addressReceiver->tinh,
                    ])->name;
                    ?>
                    <tr>
                        <td><?php echo $tt++; ?></td>
                        <td><?php echo $item->maDonHang; ?></td>
                        <td><?php echo $item->tenDonHang; ?></td>
                        <td><?php echo $item->tienCod; ?></td>
                        <td><?php echo $item->khoiluong; ?></td>
                        <td><?php echo $item->ngayGui; ?></td>
                        <td><?php echo $wardReceiver.", ".$districtReceiver.", ".$provinceReceiver; ?></td>
                        <td>
                            <button type="button" data-toggle="modal"
                                data-target="#postOffice<?php echo $item->idDonHang; ?>">
                                Giao bưu cục
                            </button>
                            <button type="button" data-toggle="modal"
                                data-target="#shipper<?php echo $item->idDonHang; ?>">
                                Shipper giao
                            </button>
                            <button type="button" data-toggle="modal"
                                data-target="#detail<?php echo $item->idDonHang; ?>">
                                Chi tiết
                            </button>
                        </td>
                    </tr>
                    <!-- Modal delivery Post Office -->
                    <div class="modal fade" id="shipper<?php echo $item->idDonHang; ?>" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="<?php echo $this->geturl("order-divide") ?>" method="POST">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Shipper giao</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="input-group">
                                            <div style="display: none">
                                                <input name="orderId" value="<?php echo $item->maDonHang; ?>">
                                                <input name="address" value="<?php echo $wardReceiver.", ".$districtReceiver.", ".$provinceReceiver; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="shipper">Chọn nhân viên giao hàng</label>
                                                <div class="col-md-12">
                                                    <select id="shipper" name="shipperId" class="form-control"
                                                        required>
                                                        <option value="">Chọn một shipper</option>
                                                        <?php foreach($shippers as $item1) : ?>
                                                        <option value="<?php echo $item1->idNhanVien ?>"><?php echo $item1->tenNhanVien." - ".$item1->soDienThoai ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="btnPostoffice" class="btn btn-default">Xác nhận</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal delivery Post Office -->
                    <div class="modal fade" id="postOffice<?php echo $item->idDonHang; ?>" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="<?php echo $this->geturl("order-divide") ?>" method="POST">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Giao bưu cục</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="input-group">
                                            <div style="display: none">
                                                <input name="orderId" value="<?php echo $item->maDonHang; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="postoffice">Chọn bưu cục</label>
                                                <div class="col-md-12">
                                                    <select id="postoffice" name="postofficeId" class="form-control"
                                                        required>
                                                        <option value="">Chọn một bưu cục</option>
                                                        <?php
                                                        $areas = Area::finds([
                                                            "district" => $addressReceiver->huyen,
                                                        ]);
                                                        ?>
                                                        <?php foreach($areas as $item2) : ?>
                                                        <?php if ($item2->idBuuCuc != $postoffice) : ?>
                                                        <?php
                                                        $postofficeReceiver = Postoffice::find([
                                                            "idBuuCuc" => $item2->idBuuCuc,
                                                        ]);    
                                                        ?>
                                                        <option value="<?php echo $item2->idBuuCuc ?>"><?php echo $postofficeReceiver->tenBuuCuc ?></option>
                                                        <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="btnPostoffice" class="btn btn-default">Xác nhận</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal xem chi tiết -->
                    <div class="modal fade" id="detail<?php echo $item->idDonHang; ?>" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Chi tiết đơn hàng</h4>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <h4 class="text-center">Thông tin người nhận</h4>
                                        <div class="sub-tt-hd">
                                            <p>Tên: <b><?php echo $infoReceiver->ten; ?></b></p>
                                            <p>Số điện thoại: <b><?php echo $infoReceiver->soDienThoai; ?></b></p>
                                            <p>Địa chỉ chi tiết: <b><?php echo $addressReceiver->chiTiet; ?></b></p>
                                            <p>Địa chỉ:
                                                <b><?php echo $wardReceiver.", ".$districtReceiver.", ".$provinceReceiver; ?></b>
                                            </p>
                                        </div>
                                    </div>
                                    <?php
                                        $infoSender = AddressSender::find([
                                            "idTTNguoiGui" => $item->idTTNguoiGui,
                                        ]);
                                        $addressSender = AddressSender::findWithTbl("diachidonhang", [
                                            "idDiaChiDonHang" => $infoSender->idDiaChiDonHang,
                                        ]);
                                        $wardSender = Ward::find([
                                            "wards_id" => $addressSender->xa,
                                        ])->name;
                                        $districtSender = District::find([
                                            "district_id" => $addressSender->huyen,
                                        ])->name;
                                        $provinceSender = Province::find([
                                            "province_id" => $addressSender->tinh,
                                        ])->name;
                                        ?>
                                    <div>
                                        <h4 class="text-center">Thông tin người gửi</h4>
                                        <div class="sub-tt-hd">
                                            <p>Tên: <b><?php echo $infoSender->ten; ?></b></p>
                                            <p>Số điện thoại: <b><?php echo $infoSender->soDienThoai; ?></b></p>
                                            <p>Địa chỉ chi tiết: <b><?php echo $addressSender->chiTiet; ?></b></p>
                                            <p>Địa chỉ:
                                                <b><?php echo $wardSender.", ".$districtSender.", ".$provinceSender; ?></b>
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-center">Thông tin đơn hàng</h4>
                                        <div class="sub-tt-hd">
                                            <p>Tên: <b><?php echo $item->tenDonHang; ?></b></p>
                                            <p>Khối lượng: <b><?php echo $item->khoiluong; ?></b></p>
                                            <p>Kích thước: <b><?php echo $item->kichThuoc; ?></b></p>
                                            <p>Loại đơn hàng: <b><?php echo $item->loaiDonHang; ?></b></p>
                                            <p>Ngày gửi: <b><?php echo $this->convertDate($item->ngayGui); ?></b>
                                            </p>
                                            <p>Trạng thái: <b><?php echo $trangThai; ?></b></p>
                                            <p>Dịch vụ gia tăng: <b><?php echo $item->dichvuGiaTang; ?></b></p>
                                            <p>Ghi chú: <b><?php echo $item->ghiChu; ?></b></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-center">Thanh toán</h4>
                                        <div class="sub-tt-hd">
                                            <p>Hình thức thanh toán:
                                                <b><?php echo $transaction->phuongThucThanhToan; ?></b>
                                            </p>
                                            <p>Ship: <b><?php echo $this->convertToVND($ship); ?></b></p>
                                            <p>COD: <b><?php echo $this->convertToVND($item->tienCod); ?></b></p>
                                            <p>Trạng Thái: <b><?php echo $transaction->tinhTrang; ?></b></p>
                                            <p>Thời gian: <b><?php echo $transaction->thoiGian; ?></b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if ($total && $totalPages > 1) : ?>
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link"
                            href="?<?php echo $category ? "v=".$category."&" : "";?>page=<?php echo $currentPage == 1 ? $currentPage : $currentPage - 1; ?>"
                            aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item"><a class="page-link"
                            href="?<?php echo $category ? "v=".$category."&" : "";?>page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="?<?php echo $category ? "v=".$category."&" : "";?>page=<?php echo $totalPages == $currentPage ? $currentPage : $currentPage + 1;  ?>"
                            aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <?php endif;?>
        </div>
    </div>
</section>