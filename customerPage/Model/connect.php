<?php
class Ketnoidb {
    function connect(& $conn){
        $conn = mysqli_connect('localhost', 'root', '', 'db_smartship');
        if ($conn->connect_error) {
            die("connect db error!");
        }

        return $conn;

    }

    function disconnect($conn){
        $conn->close();
    }
}

?>