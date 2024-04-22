<?php
class ModelPlace {
    function getProvinces() {
        include "connect.php";
        $p = new Ketnoidb();
        $conn;
        $p->connectPlace($conn);
        $sql = "SELECT * FROM `province`";
        $result = mysqli_query($conn, $sql);
        $p->disconnect($conn);
        return $result;
    }

    function getDistricts($provinceId) {
        include "connect.php";
        $p = new Ketnoidb();
        $conn;
        $p->connectPlace($conn);
        $sql = "SELECT * FROM `district` WHERE `province_id` = '{$provinceId}'";
        $result = mysqli_query($conn, $sql);
        $p->disconnect($conn);
        return $result;
    }

    function getWards($districtId) {
        include "connect.php";
        $p = new Ketnoidb();
        $conn;
        $p->connectPlace($conn);
        $sql = "SELECT * FROM `wards` WHERE `district_id` = '{$districtId}'";
        $result = mysqli_query($conn, $sql);
        $p->disconnect($conn);
        return $result;
    }
}

?>