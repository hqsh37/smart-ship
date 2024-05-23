<?php 
include '../config.php';
$checkpassId = false;
$alert = "";
// confirm confirmId
if(isset($_POST['btnPassid'])) {
    if($_POST['passId'] === $_SESSION['auth']['regotPassId']) {
        $checkpassId = true;
        $alert = "Mã xác nhận chính xác!";
    } else {
        $checkpassId = false;
        $alert = "Mã xác nhận không đúng!";
    }

    if($alert) {
        echo '<script>
        alert("'.$alert.'");
        </script>';
    }
}

// Update mật khẩu
if(isset($_POST['btnConfirm'])) {
    $password = $_POST['password'];
    $repassword = $_POST['rePassword'];
    if($password === $repassword) {
        $updatePass = User::update([
            "idKH" => $_SESSION['auth']['userId'],
        ], [
            "matKhau" => password_hash($password, PASSWORD_DEFAULT),
        ]);
        if(!$updatePass) {
            $alert = "Đổi mật khẩu thất bại!";
        }
    } else {
        $alert = "Mật khẩu không chính xác!";
    }

    if($alert === "") {
        echo '<script>
        alert("Đổi mật khẩu thành công!");
        window.location.href = "login.php";
        </script>';
    } else {
        echo '<script>
        alert("'.$alert.'");
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
    <title>reset password</title>
</head>

<body>
    <div class="container cus-login">
        <div class="row cus-login">
            <div class=" text-center cus-login">
                <h5>FORGOT PASSWORD</h5>
            </div>
            <div class="card-body">
                <form role="form" action="reset-password.php" method="POST">
                    <?php if($checkpassId) : ?>
                    <div class="col-md-12 mb-3">
                        <label for="password"><b>Mật khẩu:</b></label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="mật khẩu"
                            min="8" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="rePassword"><b>Nhập lại mật khẩu:</b></label>
                        <input type="password" name="rePassword" id="rePassword" class="form-control"
                            placeholder="nhập lại mật khẩu" min="8" required>
                    </div>
                    <div class="form-group cus-form">
                        <button type="submit" name="btnConfirm" class="btn btn-outline-dark btn-cus">CONFiRM</button>
                    </div>
                    <?php else : ?>
                    <div class="col-md-12 mb-3">
                        <label for="passId"><b>Mã xác nhận:</b></label>
                        <input type="text" id="passId" class="form-control" placeholder="Nhập mã xác nhận"
                            name="passId" pattern="[0-9]{6}" maxlength="6" required>
                        <small>mã xác nhận bao gồm 6 chữ số</small>
                    </div>
                    <div class="form-group cus-form">
                        <button type="submit" name="btnPassid" class="btn btn-outline-dark btn-cus">CONFIRM</button>
                    </div>
                    <?php endif; ?>

                    <br />
                    <div class="">
                        <p class="">Return to the login page? <a href="login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
</body>

</html>