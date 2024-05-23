<?php
class Ward extends Database {
    protected $table = "wards";

    public static function finds($data) {
        $_this = new static();
        $result = [];
        $rule = "";
        foreach ($data as $key => $value) {
            $rule.= "`$key` = '$value' AND ";
        }
        $rule = rtrim($rule, "AND ");
        $sql = "SELECT * FROM `{$_this->table}` WHERE {$rule} ORDER BY `wards`.`name` ASC";
        $query = $_this->conn->query($sql);
        $_this->conn->close();
        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }
        return $result;
    }
}
?>