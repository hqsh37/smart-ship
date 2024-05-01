<?php
class App {
    public $root;
    public $app_folder;
    public $http_host;
    public $urls;


    public function __construct() {
        $root = str_replace('/index.php', '', $_SERVER["SCRIPT_FILENAME"]);
        $uri = $_SERVER['REQUEST_URI'];
        $app_folder = str_replace('/index.php', '', $_SERVER["SCRIPT_NAME"]);
        $http_host = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$app_folder;
        $url = str_replace($app_folder.'/', '', $uri);
        $url = explode('?', $url)['0'];
        $url = rtrim($url, '/');
        $urls = explode('/', $url);

        $this->root = $root;
        $this->app_folder = $app_folder;
        $this->http_host = $http_host;
        $this->urls = $urls;

    }

    public function geturl($path) {
        return $this->http_host.'/'.$path;
    }

    public function setsession($typeUser, $name, $id, $chuVu) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION[$typeUser]["id"] = $id;
        $_SESSION[$typeUser]["name"] = $name;
        $_SESSION[$typeUser]["chucVu"] = $chucVu;
    }

    public function run() {
        if (count($this->urls) == 0 || $this->urls[0] == 'home' || $this->urls[0] == '') {
            include $this->root.'/views/main.php';
        } elseif (count($this->urls) > 0)  {
            $path_page = $this->root.'/views/'.$this->urls[0].'.php';
            if(file_exists($path_page)) {
                require $path_page;
            } else {
                include $this->root.'/views/404.php';
            }
        }
        
    }
}