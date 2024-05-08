<?php
// Session start
session_start();

// Config const and import librs automation
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASSWORD', '');
define('DB', 'db_smartShip');
define('PROJECT_NAME', '/smart-ship');

// checking session
// if(isset($_SESSION['auth'])) {
//     echo '<script>
//     window.location.href = "'.PROJECT_NAME.'/auth/login.php";
//     </script>';
// } 

// Lấy thời gian Việt Nam
date_default_timezone_set('Asia/Ho_Chi_Minh');

$root = $_SERVER['DOCUMENT_ROOT'];
$app_folder = $root.PROJECT_NAME;
$http_host = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'];
$http_api = $http_host.PROJECT_NAME.'/api/';

define('APP_PATH', $app_folder);
define('API_URL', $http_api);

spl_autoload_register(function($className) {
    $class_path = APP_PATH."/librs/".$className.".php";
    if(file_exists($class_path)) {
        require $class_path;
    } else {
        echo "class $class_path not found!!";
        die();
    }
});
$app = new App();
?>