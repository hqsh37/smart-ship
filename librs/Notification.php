<?php 
class Notification extends Database {
    protected $table = 'thongbao';

    public static function finds($data, $select = '*', $limit = 10) {
        $_this = new static();
        $result = [];
        $rule = "";
        foreach ($data as $key => $value) {
            $rule.= "`$key` = '$value' AND ";
        }
        $limitString = "";
        if($limit === 0) {
            $limitString = "";
        } else {
            $limitString = "LIMIT {$limit}";
        }
        $rule = rtrim($rule, "AND ");
        $sql = "SELECT {$select} FROM `{$_this->table}` WHERE {$rule} ORDER BY `thongbao`.`idThongBao` DESC $limitString";
        $query = $_this->conn->query($sql);
        $_this->conn->close();
        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }
        return $result;
    }
}