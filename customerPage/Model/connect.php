<?php
class Ketnoidb {
    function connect(& $conn){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_smartship";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        if ($conn) {
            $conn -> set_charset("utf8");
            return $conn;
        }else {
            return false;
        }
    }

    function connectPlace(& $conn){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "unitop_db_place";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        if ($conn) {
            $conn -> set_charset("utf8");
            return $conn;
        }else {
            return false;
        }
    }

    function disconnect($conn){
        mysqli_close($conn);
    }
}

?>