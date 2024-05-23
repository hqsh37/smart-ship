<?php
class Order extends Database {
    protected $table = 'donhang';

    public static function findShow($data, $select ="*", $limit = 15, $offset = 0) {
        $_this = new static();
        $result = [];
        $rule = "";
        foreach ($data as $key => $value) {
            $rule.= "`$key` = '$value' AND ";
        }
        $rule = rtrim($rule, "AND ");
        $sql = "SELECT {$select} FROM `{$_this->table}` WHERE {$rule} ORDER BY `donhang`.`idDonHang` DESC LIMIT {$offset}, {$limit}";
        $query = $_this->conn->query($sql);
        $_this->conn->close();
        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }
        return $result;
    }
}

?>