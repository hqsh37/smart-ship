<?php
$page1 = isset($_GET['page1']) ? $_GET['page1'] : '0';
$url = isset($_GET['page']) ? $_GET['page'] : '/';

if (strpos($url, 'smartShip/') === 0) {
    $url = substr($url, strlen('smartShip/'));
}

switch($url) {
    case 'api':
        if(!!$page1 && $page1 === "district") {
            include './customerPage/Api/district.php';
            break;
        }
        if(!!$page1 && $page1 === "ward") {
            include './customerPage/Api/ward.php';
            break;
        }
        break;
    default:
        include "./customerPage/index.php";
        break;

}
?>