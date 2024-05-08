<?php
include "../config.php"; 
if (isset($_SESSION['employee'])) {
    echo '<script>
    alert("Bạn đã đăng nhập rồi!");
    window.location.href = "'.PROJECT_NAME.'/employee/home";
    </script>';
    exit();
}

if (isset($_SESSION['delivery'])) {
    echo '<script>
    alert("Bạn đã đăng nhập rồi!");
    window.location.href = "'.PROJECT_NAME.'/delivery/home";
    </script>';
    exit();
}

if (isset($_POST['btnLogin'])) {
    $employeeId = $_POST['manv'];
    $password = $_POST['password'];

    $error = "";

    $checkEmployeeId = Employee::find([
        "maNhanVien" => $employeeId,
    ]);

    if ($checkEmployeeId->chucVu === "employee" || $checkEmployeeId->chucVu === "owner" || $checkEmployeeId->chucVu === "manager") {
        $pass_hash = $checkEmployeeId->matKhau;
        if(!password_verify($password, $pass_hash)) {
            $error = "Tài khoản mật khẩu không chính xác";
        } else {
            $_SESSION['employee'] = Employee::find([
                "maNhanVien" => $employeeId,
            ], " `idNhanVien`, `idBuuCuc`, `maNhanVien`, `chucVu`, `tenNhanVien`, `email`");
        }
    } elseif ($checkEmployeeId->chucVu === "delivery") {
        $pass_hash = $checkEmployeeId->password;
        if(!password_verify($password, $pass_hash)) {
            $error = "Tài khoản mật khẩu không chính xác";
        } else {
            $_SESSION['delivery'] = Employee::find([
                "maNhanVien" => $employeeId,
            ], " `idNhanVien`, `idBuuCuc`, `maNhanVien`, `chucVu`, `tenNhanVien`, `email`");
        }
    } else {
        $error = "Tài khoản mật khẩu không chính xác!";
    }

    if($error === "") {
        echo '<script>
        alert("Đăng nhập thành công!");
        window.location.href = "'.PROJECT_NAME.'/employee/home";
        </script>';
    } else {
        echo '<script>
        alert("'.$error.'");
        window.location.href = "employee-login.php";
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
                <form role="form" action="employee-login.php" method="POST">
                    <div class="form-group">
                        <label for="manv">Employee ID:</label>
                        <input type="text" name="manv" class="form-control" placeholder="Nhập mã nhân viên" name="manv" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group cus-form">
                        <button type="submit" name="btnLogin" class="btn btn-outline-dark btn-cus">Login</button>
                    </div>
                    <br />
                    <div>
                        <p>Switch to client login <a href="login.php">client Login</a></p>
                    </div>  
                </form>
            </div>
        </div>
</body>

</html>