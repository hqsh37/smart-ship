<?php
class ModelDonhang {
    // SELECT * FROM `donhang` WHERE `idKH` = '1'
    function xemDHwithUser($maKH) {
        include "connect.php";
        $p = new Ketnoidb();
        $conn;
        $p->connect($conn);
        $sql = "SELECT * FROM `donhang` WHERE `idKH` = '".$maKH."'";
        $result = mysqli_query($conn, $sql);
        $p->disconnect($conn);

        if($result->num_rows > 0) {
            $data = array();
            // `idDonHang`, `idKH`, `idDonHuy`, `idNhapKho`, `maDonHang`, `idBuuCuc`, `tenDonHang`, `hinhThucGuiHang`, `ngayGui`, `trangThai`, `hinhThucGiao`, `kichThuoc`, `loaiDonHang`, `dichvuGiaTang`, `ghiChu`
            while($row = $result->fetch_assoc()) {
                $item = array(
                    "idDonHang"=>$row["idDonHang"],
                    "maDonHang"=>$row["maDonHang"],
                    "tenDonHang"=>$row["tenDonHang"],
                    "hinhThucGuiHang"=>$row["hinhThucGuiHang"],
                    "ngayGui"=>$row["ngayGui"],
                    "trangThai"=>$row["trangThai"],
                    "hinhThucGiao"=>$row["hinhThucGiao"],
                    "kichThuoc"=>$row["kichThuoc"],
                    "loaiDonHang"=>$row["loaiDonHang"],
                    "dichvuGiaTang"=>$row["dichvuGiaTang"],
                    "ghiChu"=>$row["ghiChu"],
                );

                $data[] = $item;
            }

            return $data;
        } else {
            return false;
        }
    }
}
?>