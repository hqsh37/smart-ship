<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $auth = true;
    
    $idkh = $user->idKH;
    $name = $user->hoTen;
    $birth = $user->sinhNhat;
    $gender = $user->gioiTinh;
    $phone = $user->soDienThoai;
    $email = $user->email;

    $alert = "";
    if (isset($_POST['btnName'])) {
        $txtName = $_POST['txtName'];

        $checkUpName = User::update([
            "idKH" => $idkh,
        ],[
            "hoTen" => $txtName,
        ]);
        
        if($checkUpName) {
            $_SESSION['user'] = User::find([
                "idKH" => $idkh,
            ]);
            $alert = "Cập nhật thành công";
        } else {
            $alert = "Cập nhật thất bại";
        }
    }

    if (isset($_POST['btnPhone'])) {
        $txtPhone = $_POST['txtPhone'];

        $checkUpPhone = User::update([
            "idKH" => $idkh,
        ],[
            "soDienThoai" => $txtPhone,
        ]);

        if($checkUpPhone) {
            $_SESSION['user'] = User::find([
                "idKH" => $idkh,
            ]);
            $alert = "Cập nhật thành công";
        } else {
            $alert = "Cập nhật thất bại";
        }
    }

    if($alert) {
        echo '<script>
            alert("'.$alert.'");
            window.location.href = "'.$this->geturl("user-info").'";
            </script>';
    }

} else {
    $auth = false;
}
?>

<div class="user-info">
    <div class="container">
        <h2 class="info-title">Thông tin cá nhân</h2>
        <?php if ($auth) : ?>
        <form method="POST" action="<?php $this->geturl("user-info")?>">
            <div class="wrap-content">
                <div class="content">
                    <h3 class="content-label">Họ tên</h3>
                    <div class="content-input">
                        <input type="text" class="form-control" id="txt-name" name="txtName" placeholder="Nhập họ tên"
                            value="<?php echo $name; ?>" disabled>
                        <!-- <div class="content-description">
                            <p></p>
                        </div> -->
                    </div>
                </div>
                <div class="field-btn">
    
                    <button class="updateButton" type="button">Cập nhật</button>
                    <div class="update-section">
                        <button class="update-dc" type="submit" name="btnName">Lưu</button>
                        <button class="cancelButton" type="button">Thoát</button>
                    </div>
                </div>
            </div>
        </form>
        <form method="POST" action="<?php $this->geturl("user-info")?>">
            <div class="wrap-content">
                <div class="content">
                    <h3 class="content-label">Số điện thoại</h3>
                    <div class="content-input">
                        <input type="text" class="form-control" id="txt-phone" name="txtPhone" placeholder="Nhập số điện thoại"
                            value="<?php echo $phone; ?>" disabled>
                        <!-- <div class="content-description">
                            <p></p>
                        </div> -->
                    </div>
                </div>
                <div class="field-btn">
    
                    <button class="updateButton" type="button">Cập nhật</button>
                    <div class="update-section">
                        <button class="update-dc" type="submit" name="btnPhone">Lưu</button>
                        <button class="cancelButton" type="button">Thoát</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="wrap-content">
            <div class="content">
                <h3 class="content-label">Email</h3>
                <div class="content-input">
                    <input type="text" class="form-control" id="txt-email" placeholder="Nhập email"
                        value="<?php echo $email; ?>" disabled>
                    <!-- <div class="content-description">
                        <p></p>
                    </div> -->
                </div>
            </div>
            <div class="field-btn">
            </div>
        </div>
        <div class="wrap-content">
            <div class="content">
                <h3 class="content-label">Giới tính</h3>
                <div class="content-input">
                    <input type="text" class="form-control" id="txt-gender" placeholder="Nhập email"
                        value="<?php echo ($gender === "male") ? "Nam" : "Nữ"; ?>" disabled>
                    <!-- <div class="content-description">
                        <p></p>
                    </div> -->
                </div>
            </div>
            <div class="field-btn">
            </div>
        </div>
        <div class="wrap-content">
            <div class="content">
                <h3 class="content-label">Sinh nhật</h3>
                <div class="content-input">
                    <input type="text" class="form-control" id="txt-birth" placeholder="Nhập họ tên"
                        value="<?php echo $this->convertDate($birth) ?>" disabled>
                    <!-- <div class="content-description">
                        <p></p>
                    </div> -->
                </div>
            </div>
            <div class="field-btn">
            </div>
        </div>
        <?php else : ?>
        <div class="no-user">
            <h3>Vui lòng đăng nhập để sử dụng tính năng này!</h3>
        </div>
        <?php endif; ?>  
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var updateButtons = document.querySelectorAll(".updateButton");
        updateButtons.forEach(function(updateButton) {
            updateButton.addEventListener("click", function() {
                var updateSection = this.nextElementSibling;
                updateSection.style.display = "block";
                this.style.display = "none";
                var inputContainer = this.parentElement.parentElement.querySelector(".content-input input");
                inputContainer.removeAttribute("disabled");
                inputContainer.focus();
            });

            var cancelButton = updateButton.nextElementSibling.querySelector(".cancelButton");
            cancelButton.addEventListener("click", function() {
                var updateButton = this.parentElement.previousElementSibling;
                updateButton.style.display = "block";
                this.parentElement.style.display = "none";
            });
        });
    });
</script>