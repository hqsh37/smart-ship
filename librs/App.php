<?php
// use library php mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

    public function convertDate($date) {
        $date = explode('-', $date);
        return $date[2].'/'.$date[1].'/'.$date[0];
    }

    function convertToVND($number) {
        $vndString = number_format($number, 0, ',', '.') . '₫';
        
        return $vndString;
    }

    // func generate UUID from string
    function generateId($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
    
        return $randomString;
    }

    // func generate random number
    function generateRandomNumbers($length) {
        $numberString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $numberString .= rand(0, 9);
        }
    
        return $numberString;
    }

    // func Send Email Message
    public function sendmail($mail_client, $name_client, $subject, $message) {
        $mail = new PHPMailer(true);

        try {
            // Cấu hình máy chủ SMTP
            $mail->SMTPDebug = 0; // Bật chế độ debug để kiểm tra lỗi chi tiết
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Máy chủ SMTP của Gmail
            $mail->SMTPAuth   = true;
            $mail->Username   = MAIL_NAME; // Tài khoản Gmail của bạn
            $mail->Password   = MAIL_PASSWORD; // Mật khẩu hoặc mật khẩu ứng dụng
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Sử dụng mã hóa TLS
            $mail->Port       = 587; // Cổng SMTP cho TLS

            // Người gửi và người nhận
            $mail->setFrom(MAIL_NAME, USER_NAME);
            $mail->addAddress($mail_client, $name_client); // Người nhận

            // Nội dung email
            $mail->isHTML(true); // Định dạng email là HTML
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $subject;
            $mail->Body    = $message;
            // $mail->AltBody = 'This is your daily report.';

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

    // funtion covert persent
    public function convertPersent($persent) {
        $persent = $persent * 100;
        $persent = number_format($persent, 0, ',', '.').'%';
        return $persent;
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