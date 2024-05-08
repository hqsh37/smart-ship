<?php
// name: Quang Sang Hoàng
// postofficeId: AB1234
// phone: 0328435442
// email: hqsh37@gmail.com
// address: 27 Vườn Lài
// province: 50
// district: 551
// wards: 8685
// position: c1
// btnCreatePostoffice: Tạo bưu cục

if (isset($_POST['btnCreatePostoffice'])) {
    $name = $_POST['name'];
    $postofficeId = $_POST['postofficeId'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $wards = $_POST['wards'];
    $position = $_POST['position'];

    $result = Postoffice::create([
        "tenBuuCuc" => $name,
        "maBuuCuc" => $postofficeId,
        "soDienThoai" => $phone,
        "email" => $email,
        "diaChi" => $address,
        "province" => $province,
        "district" => $district,
        "ward" => $wards,
        "cap" => $position,
    ]);

    if ($result) {
        echo '<script>
            alert("Thêm thành công!");
            window.location.href = "'.$this->geturl('postoffice').'";
        </script>';
    } else {
        echo '<script>
            alert("Thêm thất bại!")
            window.location.href = "'.$this->geturl('create-postoffice').'";
        </script>';
    }
}
?>
<section class="content">
    <h4 class="title text-center mt-4">Cấp tài khoản</h4>
    <form action="<?php echo $this->geturl("create-postoffice")?>" method="POST">
        <div class="row">
            <div class="col-md-6 mt-8">
                <label for="name"><b>Tên bưu cục:</b></label>
                <input type="text" id="name" class="form-control" placeholder="Nhập họ và tên" name="name" required>
            </div>
            <div class="col-md-6 mt-8">
                <label for="postofficeId"><b>Mã bưu cục:</b></label>
                <input type="text" id="postofficeId" class="form-control" placeholder="Nhập mã bưu cục"
                    name="postofficeId" required>
                <small>mã bưu cục có 6 ký tự</small>
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
            <div class="col-md-12 mt-8">
                <label for="address"><b>địa chỉ chi tiết:</b></label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="col-md-12 mt-8">
                <label for="province">Tỉnh/Thành phố</label>
                <div>
                    <div class="col-md-3">
                        <select id="province" name="province" class="form-control" required>
                            <option value="">Chọn một tỉnh</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" id="district" name="district" required>
                            <option value="" selected>Chọn quận huyện</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" id="wards" name="wards" required>
                            <option value="" selected>Chọn phường xã</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-8">
                <label for="position"><b>Cấp bưu cục:</b></label>
                <select name="position" id="position" class="form-control" required="required">
                    <option value="">--chọn chức vụ---</option>
                    <option value="c1">Cấp 1</option>
                    <option value="c2">Cấp 2</option>
                    <option value="c3">Cấp 3</option>
                </select>
            </div>
        </div>
        <div class="text-center mt-4">
            <input type="submit" name="btnCreatePostoffice" value="Tạo bưu cục" class="btn btn-primary">
        </div>
    </form>
</section>
<script>
// API Place
function UpdateSelect(elementId, url, targetId) {
    var selectElement = document.getElementById(elementId);
    selectElement.addEventListener("change", function() {
        var id = this.value;
        if (id) {
            fetch(url + id)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then(data => {
                    var targetElement = document.getElementById(targetId);
                    targetElement.innerHTML = "";
                    data.forEach(function(item) {
                        var option = document.createElement("option");
                        option.value = item.id;
                        option.text = item.name;
                        targetElement.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error("Fetch error:", error);
                });
        } else {
            var targetElement = document.getElementById(targetId);
            targetElement.innerHTML = "";
            var option = document.createElement("option");
            option.value = "";
            option.text = "Chọn quận huyện";
            targetElement.append(option);
        }
    });
}

function UpdateSelectProvice(url, targetId, state) {
    var targetElement = document.getElementById(targetId);
    if (state) {
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then(data => {
                targetElement.innerHTML = "";
                data.forEach(function(item) {
                    var option = document.createElement("option");
                    option.value = item.id;
                    option.text = item.name;
                    targetElement.appendChild(option);
                });
            })
            .catch(error => {
                console.error("Fetch error:", error);
            });
    } else {
        var state = 1;
        targetElement.addEventListener("click", function() {
            if (state) {
                state = 0;
                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        targetElement.innerHTML = "";
                        data.forEach(function(item) {
                            var option = document.createElement("option");
                            option.value = item.id;
                            option.text = item.name;
                            targetElement.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error("Fetch error:", error);
                    });
            }
        })
    }
}

// Sử dụng hàm UpdateSelect
UpdateSelect("province", "<?php echo API_URL ?>/district.php?provinceId=", "district");
UpdateSelect("district", "<?php echo  API_URL ?>/ward.php?districtId=", "wards");
UpdateSelectProvice("<?php echo  API_URL ?>/province.php", "province", 1);
</script>