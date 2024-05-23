<?php
include "../config.php"; 
if (isset($_SESSION['user'])) {
    echo '<script>
    alert("Bạn đã đăng nhập rồi!");
    window.location.href = "'.PROJECT_NAME.'/home";
    </script>';
    exit();
}

if (isset($_POST['btnLogin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $error = "";

    $checkEmail = User::find([
        "email" => $email,
    ]);

    if(!$checkEmail) {
        $error = "Email chưa được dăng ký!";
    } else {
        $pass_hash = $checkEmail->matKhau;
        if(!!!password_verify($password, $pass_hash)) {
            $error = "Mật khẩu không chính xác";
        } else {
            $_SESSION['user'] = $checkEmail;
        }
    }

    if($error === "") {
        echo '<script>
        alert("Đăng nhập thành công!");
        window.location.href = "'.PROJECT_NAME.'/home";
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
    <link rel="stylesheet" href="./dist/css/style.css">
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
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group cus-form">
                        <button type="submit" name="btnLogin" class="btn btn-outline-dark btn-cus">Login</button>
                    </div>
                    <div class="">
                    <a href="forgot-password.php">forgot passord?</a>
                    </div>
                    <br />
                    <div class="">
                        <p class="">Don't have an account? <a href="signup.php">Create account</a></p>
                    </div>
                    <div class="">
                        <p class="">Switch to internal login <a href="employee-login.php">internal Login</a></p>
                    </div>
                </form>
            </div>
        </div>
</body>

</html>