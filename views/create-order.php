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

<div class="container">
    <?php if ($auth) : ?>
    <h3>Tạo đơn hàng</h3>
    <form action="<?php echo $this->geturl("pay-order") ?>" method="POST">

        <div>
            <h4 class="text-center">Thông tin người nhận</h4>
            <div class="form-group">
                <label for="txt-name">Tên người nhận</label>
                <input type="text" class="form-control" id="txt-name" name="receiverName" placeholder="Nhập tên người nhận" required>
            </div>
            <div class="form-group">
                <label for="txt-sdt">Số điện thoại</label>
                <input type="text" class="form-control" id="txt-sdt" name="receiverPhone" placeholder="Nhập số điện thoại" required>
            </div>
            <div class="form-group">
                <label for="txt-address">Địa chỉ chi tiết</label>
                <input type="text" class="form-control" id="txt-address" name="receiverPlace" placeholder="Nhập địa chỉ tiết" required>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="province">Tỉnh/Thành phố</label>
                    <div class="col">
                        <select id="province" name="province" class="form-control" required>
                            <option value="">Chọn một tỉnh</option>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-control" id="district" name="district" required>
                            <option value="" selected>Chọn quận huyện</option>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-control" id="wards" name="wards" required>
                            <option value="" selected>Chọn phường xã</option>
                        </select>
                    </div>
                </div>
                </select>
            </div>
        </div>
        <br />
        <br />

        <div>
            <h4 class="text-center">Hình thức lấy hàng</h4>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="layhang" id="lh-tannoi" value="tannoi" checked>
                <label class="form-check-label" for="lh-tannoi">
                    Lấy hàng tận nơi
                </label>
                <select class="form-control" id="diachi-ng" name="diachiTannoi">
                    <?php foreach ($address as $item) : ?>
                    <option value="<?php echo $item->idDiaChiKH ?>"><?php echo $item->address ?>,
                        <?php echo $item->wardName ?>, <?php echo $item->districtName ?>,
                        <?php echo $item->provinceName ?> - (<?php echo $item->phone ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br />
            <div class="form-check">
                <input class="form-check-input" type="radio" name="layhang" id="lh-buucuc" value="buucuc">
                <label class="form-check-label" for="lh-buucuc">
                    Gửi hàng bưu cục
                </label>
            </div>
        </div>
        <br />
        <br />

        <div>
            <h4 class="text-center">Thông tin đơn hàng</h4>
            <div class="form-group">
                <label for="txt-name-product">Tên sản phẩm</label>
                <input type="text" class="form-control" id="txt-name-product" name="productName"
                    placeholder="Nhập tên sản phẩm" required>
            </div>
            <div class="row">
                <div class="col">
                    <label for="txt-kl">Khối lượng(g)</label>
                    <input type="number" class="form-control" id="txt-kl" placeholder="Nhập khối lượng" required>
                </div>
                <div class="col">
                    <label for="txt-sl">Số lượng</label>
                    <input type="number" class="form-control" id="txt-sl" placeholder="Nhập số lượng" value="1" required>
                </div>
            </div>
            <div class="form-group">
                <label for="txt-address">Tổng khối lượng</label>
                <input type="text" class="form-control" id="txt-tongkl" value="Vui lòng khối lượng!" readonly>
            </div>
            <div class="row">
                <label for="city">Kích thước(mm)</label>
                <div class="col">
                    <input type="number" class="form-control" id="txt-dai" name="chieuDai" placeholder="Nhập chiều dài">
                </div>
                <div class="col">
                    <input type="number" class="form-control" id="txt-rong" name="chieuRong"
                        placeholder="Nhập chiều rộng">
                </div>
                <div class="col">
                    <input type="number" class="form-control" id="txt-cao" name="chieuCao" placeholder="Nhập chiều cao">
                </div>
            </div>
            <div class="form-group">
                <label for="opt-loaihang">Loại đơn hàng</label>
                <select class="form-control" id="opt-loaihang">
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
                    <input class="form-check-input" type="checkbox" value="de-vo" id="de-vo">
                    <label class="form-check-label" for="de-vo">
                        Hàng dễ vỡ
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="gia-tri-cao" id="gia-tri-cao">
                    <label class="form-check-label" for="gia-tri-cao">
                        Hàng giá trị cao
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="tai-lieu" id="tai-lieu">
                    <label class="form-check-label" for="tai-lieu">
                        Thư tín tài liệu
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="chat-long" id="chat-long">
                    <label class="form-check-label" for="chat-long">
                        Hàng chất lỏng
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="hsd-ngan" id="hsd-ngan">
                    <label class="form-check-label" for="hsd-ngan">
                        Hàng có HSD ngắn
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="sac-nhon" id="sac-nhon">
                    <label class="form-check-label" for="sac-nhon">
                        Hàng có cạnh sắc nhọn
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="nong-san" id="nong-san">
                    <label class="form-check-label" for="nong-san">
                        Nông sản, thực phẩm khô
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="nguyen-hop" id="nguyen-hop">
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
    <script>
    // Tính Khối lượng đơn hàng
    var khoiLuongElement = $('#txt-kl');
    var tongklElement = $('#txt-tongkl');
    var soluongElement = $('#txt-sl');

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


    // Sử dụng hàm UpdateSelect
    UpdateSelect("province", "<?php echo API_URL ?>/district.php?provinceId=", "district");
    UpdateSelect("district", "<?php echo  API_URL ?>/ward.php?districtId=", "wards");
    UpdateSelectProvice("<?php echo  API_URL ?>/province.php", "province", 1);
    </script>

    <?php else : ?>
    <div class="no-user">
        <h3>Vui lòng đăng nhập để sử dụng tính năng này!</h3>
    </div>

    <?php endif; ?>
</div>