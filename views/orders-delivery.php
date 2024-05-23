<?php
$auth = false;
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $auth = true;
    
    $idkh = $user->idKH;
    $name = $user->hoTen;
    $birth = $user->sinhNhat;
    $gender = $user->gioiTinh;
    $phone = $user->soDienThoai;
    $email = $user->email;

}

// $data, $select ="*", $limit = 15, $offset = 0
// pagination Product order
if ($auth) {
$productsPerPage = 15;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$category = isset($_GET['v']) ? $_GET['v'] : "";
$offset = ($currentPage - 1) * $productsPerPage;
$total= 0;
$rules = [
    "idKH" => $idkh,
];
if ($category === "xu-ly") {
    $rules["trangThai"] = "cho-duyet";
    $trangThai = "Chờ duyệt";
} else if ($category === "dang-giao") {
    $rules["trangThai"] = "da-duyet";
    $trangThai = "Đang giao";
} else if ($category === "da-giao") {
    $rules["trangThai"] = "thanh-cong";
    $trangThai = "Đã giao";
}



$ordersTotal = Order::find($rules, "COUNT(`donhang`.`idDonHang`) as 'total'");
if ($ordersTotal) {
    $total = $ordersTotal->total;
}
$totalPages = ceil($total / $productsPerPage);
$orders = Order::findShow($rules, "*", $productsPerPage, $offset);
$tt = 1;

}
?>

<div class="container cus-qldh">
    <?php if ($auth) : ?>
    <nav class="nav-dh">
        <ul>
            <li class="sub-dh">
                <a href="?v=all">Tất cả đơn hàng</a>
            </li>
            <li class="sub-dh">
                <a href="?v=dang-giao">Đơn hàng đang giao</a>
            </li>
            <li class="sub-dh">
                <a href="?v=xu-ly">Đơn chờ xử lý</a>
            </li>
            <li class="sub-dh">
                <a href="?v=da-giao">Đơn hàng đã giao</a>
            </li>
        </ul>
    </nav>
    <div class="content-dh">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mã ĐH</th>
                    <th scope="col">Tên đơn hàng</th>
                    <th scope="col">ship</th>
                    <th scope="col">COD</th>
                    <th scope="col">Ngày Gửi</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                <?php
                $trangThai = "";
                if ($order->trangThai === "cho-duyet") {
                    $trangThai = "Chờ duyệt";
                } else if ($order->trangThai === "da-duyet") {
                    $trangThai = "Đang giao";
                } else if ($order->trangThai === "thanh-cong") {
                    $trangThai = "Đã giao";
                } else if ($order->trangThai === "tu-choi") {
                    $trangThai = "Từ chối";
                }
                $transaction = Transaction::find([
                    "idGiaoDich" => $order->idGiaoDich,
                ]);
                $ship = 0;
                if($transaction) {
                    $ship = $transaction->soTien;
                }
                ?>
                <tr>
                    <th><?php echo $tt++; ?></th>
                    <th><?php echo $order->maDonHang; ?></th>
                    <th><?php echo $order->tenDonHang; ?></th>
                    <th><?php echo $this->convertToVND($ship); ?></th>
                    <th><?php echo $this->convertToVND($order->tienCod); ?></th>
                    <th><?php echo $this->convertDate($order->ngayGui); ?></th>
                    <th><?php echo $trangThai; ?></th>
                    <th>
                        <button data-bs-toggle="modal" data-bs-target="#detail<?php echo $order->idDonHang; ?>">Chi tiết</button>
                    </th>
                </tr>
                <!-- Modal thêm -->
                <div class="modal fade" id="detail<?php echo $order->idDonHang; ?>" tabindex="-1"
                    aria-labelledby="detail<?php echo $order->idDonHang; ?>Label" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detail<?php echo $order->idDonHang; ?>Label">Chi tiết đơn
                                    hàng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php
                                $infoReceiver = AddressReceiver::find([
                                    "idTTNguoiNhan" => $order->idTTNguoiNhan,
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
                                <div>
                                    <h4 class="text-center">Thông tin người nhận</h4>
                                    <div class="sub-tt-hd">
                                        <p>Tên: <b><?php echo $infoReceiver->ten; ?></b></p>
                                        <p>Số điện thoại: <b><?php echo $infoReceiver->soDienThoai; ?></b></p>
                                        <p>Địa chỉ chi tiết: <b><?php echo $addressReceiver->chiTiet; ?></b></p>
                                        <p>Địa chỉ: <b><?php echo $wardReceiver.", ".$districtReceiver.", ".$provinceReceiver; ?></b></p>
                                    </div>
                                </div>  
                                <?php
                                $infoSender = AddressSender::find([
                                    "idTTNguoiGui" => $order->idTTNguoiGui,
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
                                        <p>Địa chỉ: <b><?php echo $wardSender.", ".$districtSender.", ".$provinceSender; ?></b></p>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-center">Thông tin đơn hàng</h4>
                                    <div class="sub-tt-hd">
                                        <p>Tên: <b><?php echo $order->tenDonHang; ?></b></p>
                                        <p>Khối lượng: <b><?php echo $order->khoiluong; ?></b></p>
                                        <p>Kích thước: <b><?php echo $order->kichThuoc; ?></b></p>
                                        <p>Loại đơn hàng: <b><?php echo $order->loaiDonHang; ?></b></p>
                                        <p>Ngày gửi: <b><?php echo $this->convertDate($order->ngayGui); ?></b></p>
                                        <p>Trạng thái: <b><?php echo $trangThai; ?></b></p>
                                        <p>Dịch vụ gia tăng: <b><?php echo $order->dichvuGiaTang; ?></b></p>
                                        <p>Ghi chú: <b><?php echo $order->ghiChu; ?></b></p>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-center">Thanh toán</h4>
                                    <div class="sub-tt-hd">
                                        <p>Hình thức thanh toán: <b><?php echo $transaction->phuongThucThanhToan; ?></b></p>
                                        <p>Ship: <b><?php echo $this->convertToVND($ship); ?></b></p>
                                        <p>COD: <b><?php echo $this->convertToVND($order->tienCod); ?></b></p>
                                        <p>Trạng Thái: <b><?php echo $transaction->tinhTrang; ?></b></p>
                                        <p>Thời gian: <b><?php echo $transaction->thoiGian; ?></b></p>
                                    </div>
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
<?php else : ?>
<div class="no-user">
    <h3>Vui lòng đăng nhập để sử dụng tính năng này!</h3>
</div>

<?php endif; ?>
</div>