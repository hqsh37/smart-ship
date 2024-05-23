<?php
class Province extends Database {
    protected $table = "province";

    public static function select($select = "*") {
        $_this = new static();
        $result = [];
        $sql = "SELECT {$select} FROM `{$_this->table}` WHERE 1 ORDER BY `province`.`name` ASC";
        $query = $_this->conn->query($sql);
        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }
        return $result;
    }

}
?>