<?php
// name: Hoàng Quang Sang
// employeeId: 20108091
// position: manager
// postofficeId: HSH37S
// phone: 0328435442
// email: hqsh37@gmail.com
// birth: 2002-06-30
// gender: male
// password: 123123
// rePassword: 123123
// btnCreate: Tạo tài khoản
// `maNhanVien`, `chucVu`, `tenNhanVien`, `soDienThoai`, `matKhau`, `diaChi`, `email`

if (isset($_POST['btnCreate'])) {
    $error = "";
    $name = $_POST['name'];
    $employeeId = $_POST['employeeId'];
    $position = $_POST['position'];
    $idBuuCuc = $_SESSION['employee']->idBuuCuc;
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $birth = $_POST['birth'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $rePassword = $_POST['rePassword'];

    if($password === $rePassword) {
        $checkEmloyeeId = Employee::find([
            "maNhanVien" => $employeeId,
        ]);

        if ($checkEmloyeeId) {
            $error = "Mã nhân viên đã tồn tại!";

        } else {
            $employee = Employee::create([
                "maNhanVien" => $employeeId,
                "idBuuCuc" => $idBuuCuc,
                "chucVu" => $position,
                "tenNhanVien" => $name,
                "soDienThoai" => $phone,
                "matKhau" => password_hash($password, PASSWORD_DEFAULT),
                "email" => $email,
                "ngaySinh" => $birth,
                "gioiTinh" => $gender,
            ]);

            if (!$employee) {
                $error = "Tạo tài khoản thất bại!";
            }

        }
    } else {
        $error = "Mật khẩu không chính xác!";
    }

    if ($error === "") {
        echo '<script>
            alert("Tạo tài khoản thành công!");
            window.location.href = "'.$this->geturl("employeer").'";
            </script>';
    } else {
        echo '<script>alert("'. $error. '");
        window.location.href = "'.$this->geturl("create-user").'";
        </script>';
    }
}
?>

<section class="content">
    <h4 class="title text-center mt-4">Cấp tài khoản</h4>
    <form action="<?php echo $this->geturl("create-user"); ?>" method="POST">
        <div class="row">
            <div class="col-md-6 mt-8">
                <label for="name"><b>Họ và tên:</b></label>
                <input type="text" id="name" class="form-control" placeholder="Nhập họ và tên" name="name" required>
            </div>
            <div class="col-md-6 mt-8">
                <label for="employeeId"><b>Mã nhân viên:</b></label>
                <input type="text" id="employeeId" class="form-control" placeholder="Nhập mã nhân viên"
                    name="employeeId" pattern="[0-9]{8}" maxlength="8" required>
                <small>Mã nhân viên gồm 8 số</small>
            </div>
            <div class="col-md-6 mt-8">
                <label for="position"><b>chức vụ:</b></label>
                <select name="position" id="position" class="form-control" required="required">
                    <option value="">--chọn chức vụ---</option>
                    <option value="manager">Quản lý bưu cục</option>
                    <option value="employee">Nhân viên bưu cục</option>
                    <option value="shipper">Nhân viên giao hàng</option>
                </select>
            </div>
            <div class="col-md-6 mt-8">
                <label for="postofficeId"><b>Mã bưu cục:</b></label>
                <input type="text" id="postofficeId" class="form-control" placeholder="Nhập mã bưu cục" pattern=".{6}"
                    maxlength="6" name="postofficeId" required>
                <small>Mã bưu cục gồm 6 ký tự</small>
            </div>
            <div class="col-md-6 mt-8">
                <label for="phone"><b>Số điện thoại:</b></label>
                <input type="number" id="phone" class="form-control" placeholder="Nhập số điện thoại" name="phone"
                    required>
            </div>
            <div class="col-md-6 mt-8">
                <label for="email"><b>Email:</b></label>
                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input type="text" id="email" class="form-control" placeholder="Nhập email" name="email" required>
                </div>
            </div>
            <div class="col-md-6 mt-8">
                <label for="birth"><b>Năm sinh:</b></label>
                <input type="date" class="form-control" id="birth" name="birth" required>
            </div>
            <div class="col-md-6 mt-8">
                <label><b>Giới tính:</b> </label>
                <div class="radio">
                    <label><input type="radio" name="gender" value="male" checked>Nam</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="gender" value="female">Nữ</label>
                </div>
            </div>
            <div class="col-md-12 mt-8">
                <label for="password"><b>Mật khẩu:</b></label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu"
                    minlength="8" required>
            </div>
            <div class="col-md-12 mt-8">
                <label for="rePassword"><b>Nhập lại mật khẩu:</b></label>
                <input type="password" name="rePassword" id="rePassword" class="form-control"
                    placeholder="Nhập lại mật khẩu" minlength="8" required>
            </div>
        </div>
        <div class="text-center mt-8">
            <input type="submit" name="btnCreate" value="Tạo tài khoản" class="btn btn-primary">
        </div>
    </form>
</section>