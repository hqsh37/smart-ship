<?php
include "./customerPage/Controller/cPlace.php";
if(isset($_GET['provinceId'])) {
    $provinceId = $_GET['provinceId'];
    
    $p = new CtrlPlace();
    $result = $p->getDistricts($provinceId);
    // var_dump($result);
    header('Content-Type: application/json');
    echo json_encode($result);
    return;
} else {
    echo json_encode(false);
    return;
}

?>