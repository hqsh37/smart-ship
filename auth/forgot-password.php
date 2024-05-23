<?php
include "../config.php"; 
if (isset($_SESSION['user'])) {
    echo '<script>
    alert("Bạn đã đăng nhập rồi!");
    window.location.href = "'.PROJECT_NAME.'/home";
    </script>';
    exit();
}
if (isset($_POST['btnSend'])) {
    $email = $_POST['email'];

    $error = "";

    $checkEmail = User::find([
        "email" => $email,
    ]);

    if(!$checkEmail) {
        $error = "Email chưa được dăng ký!";
    } else {
        $randomNumbers = $app->generateRandomNumbers(6);
        $content_mail = '<!DOCTYPE html>
        <html>
        <head>
            <title>Yêu Cầu Đặt Lại Mật Khẩu</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    width: 100%;
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #ffffff;
                    padding: 20px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                .header {
                    background-color: #007bff;
                    color: #ffffff;
                    padding: 10px;
                    text-align: center;
                }
                .content {
                    padding: 20px;
                    text-align: center;
                }
                .content h1 {
                    font-size: 24px;
                }
                .content p {
                    font-size: 16px;
                    color: #333333;
                }
                .content button {
                    display: inline-block;
                    margin-top: 20px;
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: #ffffff;
                    text-decoration: none;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }
                .footer {
                    text-align: center;
                    margin-top: 20px;
                    font-size: 14px;
                    color: #999999;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h2>Đặt Lại Mật Khẩu</h2>
                </div>
                <div class="content">
                    <h1>Xin chào '.$checkEmail->hoTen.',</h1>
                    <p>Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn. Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
                    <p>Mã đặt lại mật khẩu là:</p>
                    <h3>'.$randomNumbers.'</h3>
                    <p>Nếu bạn gặp bất kỳ vấn đề nào, vui lòng liên hệ đội ngũ hỗ trợ của chúng tôi.</p>
                </div>
                <div class="footer">
                    <p>&copy; 2024 SmartShip.</p>
                </div>
            </div>
        </body>
        ';
        $_SESSION['auth']['regotPassId'] = $randomNumbers;
        $_SESSION['auth']['userId'] = $checkEmail->idKH;
        $app->sendmail($email, $checkEmail->hoTen, 'Đặt lại mật khẩu', $content_mail);
    }

    if($error === "") {
        echo '<script>
        alert("Thành công! \nVui lòng kiểm tra hòm thư mail của bạn!");
        window.location.href = "reset-password.php";
        </script>';
    } else {
        echo '<script>
        alert("'.$error.'");
        window.location.href = "forgot-password.php";
        </script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./dist/css/style.css">
    <title>forgot password</title>
</head>

<body>
    <div class="container cus-login">
        <div class="row cus-login">
            <div class=" text-center cus-login">
                <h5>FORGOT PASSWORD</h5>
            </div>
            <div class="card-body">
                <form role="form" action="forgot-password.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                    </div>
                    <div class="form-group cus-form">
                        <button type="submit" name="btnSend" class="btn btn-outline-dark btn-cus">SEND</button>
                    </div>
                    <br />
                    <div class="">
                        <p class="">Return to the login page? <a href="login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
</body>

</html>