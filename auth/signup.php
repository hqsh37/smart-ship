<?php
include "../config.php";


if(isset($_POST['btnSignup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birth = $_POST['birth'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $repassword = $_POST['rePassword'];

    $error = "";

    if($password === $repassword) {
        $checkEmail = User::find([
            "email" => $email,
        ]);

        if($checkEmail) {
            $error = "Email đã tồn tại";
        } else {
            // `hoTen`, `sinhNhat`, `gioiTinh`, `soDienThoai`, `email`, `matKhau`
            $checkAdd = User::create([
                "hoTen" => $name,
                "sinhNhat" => $birth,
                "gioiTinh" => $gender,
                "soDienThoai" => $phone,
                "email" => $email,
                "matKhau" => password_hash($password, PASSWORD_DEFAULT),
            ]);

            if(!$checkAdd) {
                $error = "Đăng ký thất bại!";
            }
        }

    } else {
        $error = "Mật khẩu không chính xác!";
    }

    
    if($error === "") {
        echo '<script>
        alert("Đăng ký thành công!");
        window.location.href = "login.php";
        </script>';
    } else {
        echo '<script>
        alert("'.$error.'");
        window.location.href = "signup.php";
        </script>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="./dist/css/style.css">
</head>

<body>
    <div class="container cus-signup">
        <div class="row px-3">
            <div class="col-lg-12 col-xl-12 card flex-row mx-auto px-0">
                <div class="card-body col-lg-12">
                    <h4 class="title text-center mt-4">
                        SIGN UP
                    </h4>
                    <form action="signup.php" method="POST">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="name"><b>Họ và tên:</b></label>
                                <input type="text" id="name" class="form-control" placeholder="Nhập họ và tên" name ="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone"><b>Số điện thoại:</b></label>
                                <input type="number" id="phone" class="form-control" placeholder="Nhập số điện thoại" name="phone" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email"><b>Email:</b></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend3">@</span>
                                    </div>
                                    <input type="text" id="email" class="form-control" placeholder="Nhập email" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="birth"><b>Năm sinh:</b></label>
                                <input type="date" class="form-control" id="birth" name="birth" required>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for=""><b>Giới tính:</b> </label>
                                <input type="radio" name="gender" id="male" value="male" class="ml-3" checked>
                                <label for="male">Nam</label>
                                <input type="radio" name="gender" id="famale" value="famale" class="ml-3">
                                <label for="famale">Nữ</label>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="password"><b>Mật khẩu:</b></label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="mật khẩu" min="8" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="rePassword"><b>Nhập lại mật khẩu:</b></label>
                                <input
                                    type="password"
                                    name="rePassword"
                                    id="rePassword"
                                    class="form-control"
                                    placeholder="nhập lại mật khẩu" 
                                    min="8"
                                    required
                                >
                            </div>
                        </div>
                        <div class="form-row">
                        </div>
                        <div class="text-center">
                            <input type="submit" name="btnSignup" value="Sign up" class="btn btn-primary">
                        </div>
                        <hr class="my-1">
                        <div class="text-center mb-2">
                            You already have a Sign up?
                            <b><a href="login.php" class="text-danger"> Login </a></b>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
