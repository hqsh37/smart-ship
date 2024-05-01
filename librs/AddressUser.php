<?php
class AddressUser extends Database {
    protected $table = 'diachikh';

    public function __construct() {
        parent::__construct();
    }

    public static function finds($data) {
        $_this = new static();
        $keys = array_keys($data);
        $values = array_values($data);
        $result = [];
        $sql = "SELECT diachikh.*, wards.name as 'wardName', district.name as 'districtName', province.name as 'provinceName' 
            FROM diachikh 
            LEFT JOIN wards ON diachikh.wards = wards.wards_id 
            LEFT JOIN district ON diachikh.district = district.district_id 
            LEFT JOIN province ON diachikh.province = province.province_id 
            WHERE `$keys[0]` = '$values[0]'";
        $query = $_this->conn->query($sql);
        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }
        return $result;
    }


}