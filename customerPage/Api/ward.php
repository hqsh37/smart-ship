<?php
include "./customerPage/Controller/cPlace.php";
if(isset($_GET['districtId'])) {
    $districtId = $_GET['districtId'];
    
    $p = new CtrlPlace();
    $result = $p->getWards($districtId);
    // var_dump($result);
    header('Content-Type: application/json');
    echo json_encode($result);
    return;
} else {
    echo json_encode(false);
    return;
}
?>