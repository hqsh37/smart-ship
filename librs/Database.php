<?php
class Database {
    protected $conn;
    protected $table = "diachikh";

    function __construct() {
        $this->conn = mysqli_connect(HOST, USER, PASSWORD, DB);
    }

    public static function select($select = "*") {
        $_this = new static();
        $result = [];
        $sql = "SELECT {$select} FROM `{$_this->table}` WHERE 1";
        $query = $_this->conn->query($sql);
        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }
        return $result;
    }

    public static function find($data, $select="*") {
        $_this = new static();
        $rule = "";
        foreach ($data as $key => $value) {
            $rule.= "`$key` = '$value' AND ";
        }
        $rule = rtrim($rule, "AND ");
        $sql = "SELECT {$select} FROM `{$_this->table}` WHERE {$rule} LIMIT 1";
        $query = $_this->conn->query($sql);
        $_this->conn->close();
        return $query->fetch_object();
    }
    
    public static function finds($data) {
        $_this = new static();
        $result = [];
        $rule = "";
        foreach ($data as $key => $value) {
            $rule.= "`$key` = '$value' AND ";
        }
        $rule = rtrim($rule, "AND ");
        $sql = "SELECT * FROM `{$_this->table}` WHERE {$rule}";
        $query = $_this->conn->query($sql);
        $_this->conn->close();
        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }
        return $result;
    }

    public static function findsWithOr($data) {
        $_this = new static();
        $result = [];
        $rule = "";
        foreach ($data as $key => $value) {
            $rule.= "`$key` = '$value' OR ";
        }
        $rule = rtrim($rule, "OR ");
        $sql = "SELECT * FROM `{$_this->table}` WHERE {$rule}";
        $query = $_this->conn->query($sql);
        $_this->conn->close();
        while ($row = $query->fetch_object()) {
            $result[] = $row;
        }
        return $result;
    }

    public static function create($data) {
        $_this = new static();
        $keys = array_keys($data);
        $keys = implode("`, `", $keys);
        $values = array_values($data);
        $values = implode("', '", $values);
        $sql = "INSERT INTO `{$_this->table}` (`$keys`) VALUES ('$values')";
        $query = $_this->conn->query($sql);
        $_this->conn->close();
        return $query;
    }

    
    public static function update($id, $data) {
        $_this = new static();
        $keyID = array_keys($id);
        $valueID = array_values($id);
        $sql = "UPDATE `{$_this->table}` SET ";
        foreach($data as $key => $value) {
            $sql .= "`$key` = '$value', ";
        }
        $sql = rtrim($sql, ", ");
        $sql.= " WHERE `$keyID[0]` = '$valueID[0]'";
        $query = $_this->conn->query($sql);
        $_this->conn->close();
        return $query;
    }

    public static function delete($id) {
        $_this = new static();
        $keyID = array_keys($id)[0];
        $valueID = array_values($id)[0];
        $sql = "DELETE FROM `{$_this->table}` WHERE `$keyID` = '$valueID'";
        $query = $_this->conn->query($sql);
        $_this->conn->close();
        return $query;
    }

    public static function findWithTbl($table, $data) {
        $_this = new static();
        $keys = array_keys($data);
        $values = array_values($data);
        $sql = "SELECT * FROM `{$table}` WHERE `$keys[0]` = '$values[0]' LIMIT 1";
        $query = $_this->conn->query($sql);
        $_this->conn->close();
        return $query->fetch_object();
    }

    public static function createMoreTbl($data, $table) {
        $_this = new static();
        $keys = array_keys($data);
        $keys = implode("`, `", $keys);
        $values = array_values($data);
    
        $params = implode(", ", array_fill(0, count($data), "?"));
    
        $sql = "INSERT INTO `$table` (`$keys`) VALUES ($params)";
        $stmt = $_this->conn->prepare($sql);
    
        if (!$stmt) {
            die('Error: ' . $_this->conn->error);
        }
    
        $types = str_repeat('s', count($data));
        $stmt->bind_param($types, ...$values);
    
        $stmt->execute();
    
        // Trả về ID của bản ghi vừa được tạo
        return $_this->conn->insert_id;
    }
}
?>