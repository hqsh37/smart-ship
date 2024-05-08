<?php
class AddressUser extends Database {
    protected $table = 'diachikh';

    public function __construct() {
        parent::__construct();
    }

    public static function find($data, $select = null) {
        $_this = new static();
        $keys = array_keys($data);
        $values = array_values($data);
        $sql = "SELECT diachikh.*, wards.name as 'wardName', district.name as 'districtName', province.name as 'provinceName' 
            FROM diachikh 
            LEFT JOIN wards ON diachikh.wards = wards.wards_id 
            LEFT JOIN district ON diachikh.district = district.district_id 
            LEFT JOIN province ON diachikh.province = province.province_id 
            WHERE `$keys[0]` = '$values[0]' LIMIT 1";
        $query = $_this->conn->query($sql);
        $_this->conn->close();
        return $query->fetch_object();
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
        $_this->conn->close();
        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }
        return $result;
    }

    public static function getNamePlace($idward) {
        $_this = new static();
        $sql = "SELECT wards.name as 'wardName', district.name as 'districtName', province.name as 'provinceName' 
        FROM wards  
        LEFT JOIN district ON wards.district_id = district.district_id 
        LEFT JOIN province ON district.province_id = province.province_id 
        WHERE wards.wards_id = {$idward} LIMIT 1";
        $query = $_this->conn->query($sql);
        $_this->conn->close();
        return $query->fetch_object();
    }




}