<?php
// name: Hoàng Quang Sang
// adminId: 20108091
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
    $adminId = $_POST['adminId'];
    $position = $_POST['position'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $birth = $_POST['birth'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $rePassword = $_POST['rePassword'];

    if($password === $rePassword) {
        $checkAdminId = Admin::find([
            "id" => $adminId,
        ]);

        if ($checkAdminId) {
            $error = "Mã nhân viên đã tồn tại!";

        } else {
            //  `id`, `adminId`, `name`, `phone`, `email`, `position`, `password`, `birth`, `gender`
            $admin = Admin::create([
                "adminId" => $adminId,
                "position" => $position,
                "name" => $name,
                "phone" => $phone,
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "email" => $email,
                "birth" => $birth,
                "gender" => $gender,
            ]);

            if (!$admin) {
                $error = "Tạo tài khoản thất bại!";
            }

        }
    } else {
        $error = "Nhập lại mật khẩu không chính xác!";
    }

    if ($error === "") {
        echo '<script>
            alert("Tạo tài khoản thành công!");
            window.location.href = "'.$this->geturl("admin-user").'";
            </script>';
    } else {
        echo '<script>alert("'. $error. '");
        window.location.href = "'.$this->geturl("create-admin").'";
        </script>';
    }
}
?>

<section class="content">
    <h4 class="title text-center mt-4">Cấp tài khoản quản trị viên</h4>
    <form action="<?php echo $this->geturl("create-admin"); ?>" method="POST">
        <div class="row">
            <div class="col-md-6 mt-8">
                <label for="name"><b>Họ và tên:</b></label>
                <input type="text" id="name" class="form-control" placeholder="Nhập họ và tên" name="name" required>
            </div>
            <div class="col-md-6 mt-8">
                <label for="adminId"><b>Mã admin:</b></label>
                <input type="text" id="adminId" class="form-control" placeholder="Nhập mã nhân viên"
                    name="adminId" pattern="[0-9]{8}" maxlength="8" required>
                <small>Mã nhân viên gồm 8 số</small>
            </div>
            <div class="col-md-6 mt-8">
                <label for="position"><b>chức vụ:</b></label>
                <select name="position" id="position" class="form-control" required="required">
                    <option value="">--chọn chức vụ---</option>
                    <option value="owner">Quản trị viên</option>
                    <option value="user">thành viên</option>
                </select>
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