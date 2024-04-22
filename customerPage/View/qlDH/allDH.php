<?php
include "./customerPage/Controller/cDonhang.php";
$p = new CtrlDonhang();
$result = $p->xemDHwithUser("' or '1");
$display = $result ? "" : 'style="display: none;"';
if (!$result) {
    echo "<br /><center><h2>Bạn chưa có đơn hàng nào</h2></center>";
}  
?>
<table class="table" <?php echo $display; ?>>
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Mã ĐH</th>
            <th scope="col">Tên đơn hàng</th>
            <th scope="col">ship</th>
            <th scope="col">COD</th>
            <th scope="col">Ngày Gửi</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Chi tiết</th>
        </tr>
    </thead>
    <tbody>
        <!-- "idDonHang", "maDonHang", "tenDonHang", "hinhThucGuiHang", "ngayGui", "trangThai", "hinhThucGiao", "kichThuoc", "loaiDonHang", "dichvuGiaTang", "ghiChu",  -->
        <?php
            $tt = 1;
            if($result) {
                foreach ($result as $item) {
                    echo "</tr>
                    <th>".$tt."</th>
                    <th>".$item["maDonHang"]."</th>
                    <th>".$item["tenDonHang"]."</th>
                    <th>30.000đ</th>
                    <th>0đ</th>
                    <th>".$item["ngayGui"]."</th>
                    <th>".$item["trangThai"]."</th>
                    <th><a href=\"#\">Xem chi tiết</a></th>
                    </tr>";
                    $tt++;
                }
            }
            ?>

    </tbody>
</table>