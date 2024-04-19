<?php
class CtrlDonhang {
    function xemDHwithUser($maKH) {
        include "./customerPage/Model/mDonHang.php";
        $p = new ModelDonhang();
        if ($result = $p->xemDHwithUser($maKH)) {
            return $result;
        } else {
            return false;   
        }
    }
}

?>