<?php
include "../config.php"; 
if (isset($_SESSION['admin'])) {
    echo '<script>
    alert("Bạn đã đăng nhập rồi!");
    window.location.href = "'.PROJECT_NAME.'/admin/home";
    </script>';
    exit();
}

if (isset($_POST['btnLogin'])) {
    $adminId = $_POST['manv'];
    $password = $_POST['password'];

    $error = "";

    $checkAdminId = Admin::find([
        "adminId" => $adminId,
    ]);

    if(!$checkAdminId) {
        $error = "Tài khoản mật khẩu không chính xác!";
    } else {
        $pass_hash = $checkAdminId->password;
        if(!!!password_verify($password, $pass_hash)) {
            $error = "Tài khoản mật khẩu không chính xác";
        } else {
            $_SESSION['admin'] = Admin::find([
                "adminId" => $adminId,
            ], "`id`, `adminId`, `name`, `position`");
        }
    }

    if($error === "") {
        echo '<script>
        alert("Đăng nhập thành công!");
        window.location.href = "'.PROJECT_NAME.'/admin/home";
        </script>';
    } else {
        echo '<script>
        alert("'.$error.'");
        window.location.href = "login.php";
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
    <link rel="stylesheet" href="./dist/css/login.css">
    <title>Login</title>
</head>

<body>
    <div class="container cus-login">
        <div class="row cus-login">
            <div class=" text-center cus-login">
                <h5>LOGIN</h5>
            </div>
            <div class="card-body">
                <form role="form" action="login.php" method="POST">
                    <div class="form-group">
                        <label for="manv">Admin ID:</label>
                        <input type="text" id="manv" class="form-control" placeholder="Nhập mã Admin" name="manv" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group cus-form">
                        <button type="submit" name="btnLogin" class="btn btn-outline-dark btn-cus">Login</button>
                    </div>
                </form>
            </div>
        </div>
</body>

</html>