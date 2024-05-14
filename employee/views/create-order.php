<section class="content">
    <?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $auth = true;
    
    $idKH = $user->idKH;
    $address =  AddressUser::finds([
        "idKH" => $idKH,
    ]);

} else {
    $auth = false;
}
?>
    <h3>Tạo đơn hàng</h3>
    <form action="<?php echo $this->geturl("pay-order") ?>" method="POST">

        <div>
            <h4 class="text-center">Thông tin người nhận</h4>
            <div class="form-group">
                <label for="txt-name">Tên người nhận</label>
                <input type="text" class="form-control" id="txt-name" name="receiverName"
                    placeholder="Nhập tên người nhận" required>
            </div>
            <div class="form-group">
                <label for="txt-sdt">Số điện thoại</label>
                <input type="text" class="form-control" id="txt-sdt" name="receiverPhone"
                    placeholder="Nhập số điện thoại" required>
            </div>
            <div class="form-group">
                <label for="txt-address">Địa chỉ chi tiết</label>
                <input type="text" class="form-control" id="txt-address" name="receiverPlace"
                    placeholder="Nhập địa chỉ tiết" required>
            </div>
            <div class="form-group">
                <label for="province">Tỉnh/Thành phố</label>
                <div>
                    <div class="col-md-4">
                        <select id="province" name="province" class="form-control" required>
                            <option value="">Chọn một tỉnh</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" id="district" name="district" required>
                            <option value="" selected>Chọn quận huyện</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" id="wards" name="wards" required>
                            <option value="" selected>Chọn phường xã</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <br />
        <div>
            <h4 class="text-center">Thông tin người gửi</h4>
            <div class="form-group">
                <label for="txt-name">Tên người gửi</label>
                <input type="text" class="form-control" id="txt-name" name="senderName"
                    placeholder="Nhập tên người gửi" required>
            </div>
            <div class="form-group">
                <label for="txt-sdt">Số điện thoại</label>
                <input type="text" class="form-control" id="txt-sdt" name="senderPhone"
                    placeholder="Nhập số điện thoại" required>
            </div>
            <div class="form-group">
                <label for="txt-email">email</label>
                <input type="text" class="form-control" id="txt-email" name="senderEmail"
                    placeholder="Nhập số điện thoại" required>
                <small>đơn hàng sẽ tự động thêm vào tài khoản người dùng nếu nhập trường này</small>
            </div>
            <div class="form-group">
                <label for="txt-address">Địa chỉ chi tiết</label>
                <input type="text" class="form-control" id="txt-address" name="senderPlace"
                    placeholder="Nhập địa chỉ tiết" required>
            </div>
            <div class="form-group">
                <label for="provinceSender">Tỉnh/Thành phố</label>
                <div>
                    <div class="col-md-4">
                        <select id="provinceSender" name="provinceSender" class="form-control" required>
                            <option value="">Chọn một tỉnh</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" id="districtSender" name="districtSender" required>
                            <option value="" selected>Chọn quận huyện</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" id="wardsSender" name="wardsSender" required>
                            <option value="" selected>Chọn phường xã</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div>
            <h4 class="text-center">Thông tin đơn hàng</h4>
            <div class="form-group">
                <label for="txt-name-product">Tên sản phẩm</label>
                <input type="text" class="form-control" id="txt-name-product" name="productName"
                    placeholder="Nhập tên sản phẩm" required>
            </div>
            <div class="form-group">
                <div class="form-group col-md-6">
                    <label for="txt-kl">Khối lượng(g)</label>
                    <input type="number" class="form-control" id="txt-kl" name="khoiluong" placeholder="Nhập khối lượng"
                        required>
                </div>
                <div class="form-group col-md-6">
                    <label for="txt-sl">Số lượng</label>
                    <input type="number" class="form-control" id="txt-sl" name="soluong" placeholder="Nhập số lượng"
                        value="1" required>
                </div>
            </div>
            <br />
            <div class="form-group">
                <label for="txt-address">Tổng khối lượng</label>
                <input type="text" class="form-control" id="txt-tongkl" name="tongKl" value="Vui lòng khối lượng!"
                    readonly>
            </div>
            <div class="form-group">
                <label for="city">Kích thước(mm)</label>
                <div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" id="txt-dai" name="chieuDai" placeholder="Nhập chiều dài">
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" id="txt-rong" name="chieuRong"
                            placeholder="Nhập chiều rộng">
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" id="txt-cao" name="chieuCao" placeholder="Nhập chiều cao">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="opt-loaihang">Loại đơn hàng</label>
                <select class="form-control" name="loaiDH" id="opt-loaihang">
                    <option value="" selected>Chọn loại đơn hàng</option>
                    <option value="mypham">Hóa mỹ phẩm</option>
                    <option value="gomsu">Đồ thủy tinh, gốm sứ, hàng dễ vỡ</option>
                    <option value="dientu">Đồ điện tử, điện lạnh, đồ công nghệ</option>
                    <option value="sach">Sách & Văn phòng phẩm</option>
                    <option value="quanao">Quần áo, giày túi, bỉm tã</option>
                    <option value="giadung">Đồ gia dụng</option>
                    <option value="khac">Khác</option>
                </select>
            </div>
            <div class="form-group">
                <label for="opt-loaihang">Dịch vụ gia tăng</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="dichvuGT[]" value="de-vo" id="de-vo">
                    <label class="form-check-label" for="de-vo">
                        Hàng dễ vỡ
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="dichvuGT[]" value="gia-tri-cao"
                        id="gia-tri-cao">
                    <label class="form-check-label" for="gia-tri-cao">
                        Hàng giá trị cao
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="dichvuGT[]" value="tai-lieu" id="tai-lieu">
                    <label class="form-check-label" for="tai-lieu">
                        Thư tín tài liệu
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="dichvuGT[]" value="chat-long" id="chat-long">
                    <label class="form-check-label" for="chat-long">
                        Hàng chất lỏng
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="dichvuGT[]" value="hsd-ngan" id="hsd-ngan">
                    <label class="form-check-label" for="hsd-ngan">
                        Hàng có HSD ngắn
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="dichvuGT[]" value="sac-nhon" id="sac-nhon">
                    <label class="form-check-label" for="sac-nhon">
                        Hàng có cạnh sắc nhọn
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="dichvuGT[]" value="nong-san" id="nong-san">
                    <label class="form-check-label" for="nong-san">
                        Nông sản, thực phẩm khô
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="dichvuGT[]" value="nguyen-hop"
                        id="nguyen-hop">
                    <label class="form-check-label" for="nguyen-hop">
                        Hàng nguyên hộp
                    </label>
                </div>
            </div>
            <br />
            <br />
            <div class="d-flex justify-content-center align-items-center">
                <button class="btn-lg" name="btnCreateOrder">Tạo đơn hàng</button>
            </div>
        </div>
    </form>
</section>

<script>

// Tính Khối lượng đơn hàng
var khoiLuongElement = document.querySelector('#txt-kl');
var tongklElement = document.querySelector('#txt-tongkl');
var soluongElement = document.querySelector('#txt-sl');

khoiLuongElement.addEventListener("input", function() {
    var khoiluong = this.value;
    var soluong = soluongElement.value;

    if (khoiluong > 0 && soluong > 0) {
        var tongkl = khoiluong * soluong;
        tongklElement.value = convertKhoiluong(tongkl);
    }


});

soluongElement.addEventListener("input", function() {
    var khoiluong = khoiLuongElement.value;
    var soluong = this.value;

    if (khoiluong > 0 && soluong > 0) {
        var tongkl = khoiluong * soluong;
        tongklElement.value = convertKhoiluong(tongkl);
    }


});

const convertKhoiluong = (khoiluong) => {
    if (khoiluong <= 0) {
        khoiluong = "thông tin nhập không hợp lệ!";
    } else if (khoiluong > 1000) {
        khoiluong = khoiluong / 1000 + "(kg)";
    } else {
        khoiluong += "(g)";
    }
    return khoiluong;
}
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

// address reciever 
UpdateSelect("province", "<?php echo API_URL ?>/district.php?provinceId=", "district");
UpdateSelect("district", "<?php echo  API_URL ?>/ward.php?districtId=", "wards");
UpdateSelectProvice("<?php echo  API_URL ?>/province.php", "province", 1);
// address sender
UpdateSelect("provinceSender", "<?php echo API_URL ?>/district.php?provinceId=", "districtSender");
UpdateSelect("districtSender", "<?php echo  API_URL ?>/ward.php?districtId=", "wardsSender");
UpdateSelectProvice("<?php echo  API_URL ?>/province.php", "provinceSender", 1);
</script>