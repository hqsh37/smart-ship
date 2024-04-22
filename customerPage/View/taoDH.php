<div class="container">
    <h3>Tạo đơn hàng</h3>
    <form action="#" method="post">

        <div>
            <h4 class="text-center">Thông tin người nhận</h4>
            <div class="form-group">
                <label for="txt-name">Tên người nhận</label>
                <input type="text" class="form-control" id="txt-name" placeholder="Nhập tên người nhận">
            </div>
            <div class="form-group">
                <label for="txt-sdt">Số điện thoại</label>
                <input type="text" class="form-control" id="txt-sdt" placeholder="Nhập số điện thoại">
            </div>
            <div class="form-group">
                <label for="txt-address">Địa chỉ chi tiết</label>
                <input type="text" class="form-control" id="txt-address" placeholder="Nhập địa chỉ tiết">
            </div>  
            <div class="form-group">
                <div class="row">
                    <label for="province">Tỉnh/Thành phố</label>
                    <div class="col">
                        <select id="province" name="province" class="form-control">
                            <option value="">Chọn một tỉnh</option>
                            <!-- populate options with data from your database or API -->
                            <?php
                                include "./customerPage/Controller/cPlace.php";
                                $p = new CtrlPlace();
                                $arr = $p->getProvinces();
                                foreach ($arr as $item) {
                                    echo '<option value="'.$item['provinceId'].'">'.$item['name'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-control" id="district">
                            <option value="" selected>Chọn quận huyện</option>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-control" id="wards">
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
                <select class="form-control" id="diachi-ng">
                    <option value="" selected>123 gò vấp</option>
                    <option value="" selected>232 gò vấp</option>
                    <option value="" selected>544 gò vấp</option>
                    <option value="" selected>333 gò vấp</option>
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
                <label for="txt-name">Tên sản phẩm</label>
                <input type="text" class="form-control" id="txt-name" placeholder="Nhập tên sản phẩm">
            </div>
            <div class="row">
                <div class="col">
                    <label for="txt-sdt">Khối lượng</label>
                    <input type="text" class="form-control" id="txt-sdt" placeholder="Nhập khối lượng">
                </div>
                <div class="col">
                    <label for="txt-address">Số lượng</label>
                    <input type="number" class="form-control" id="txt-address" placeholder="Nhập số lượng">
                </div>
            </div>
            <div class="form-group">
                <label for="txt-address">Tổng khối lượng</label>
                <input type="text" class="form-control" id="txt-address" value="1kg" readonly>
            </div>
            <div class="row">
                <label for="city">Kích thước</label>
                <div class="col">
                    <input type="text" class="form-control" id="txt-address" placeholder="Nhập chiều dài">
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="txt-address" placeholder="Nhập chiều rộng">
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="txt-sdt" placeholder="Nhập chiều cao">
                </div>
            </div>
            <div class="form-group">
                <label for="opt-loaihang">Loại đơn hàng</label>
                <select class="form-control" id="opt-loaihang">
                    <option value="" selected>Chọn loại đơn hàng</option>
                    <option value="mypham" selected>Hóa mỹ phẩm</option>
                    <option value="gomsu" selected>Đồ thủy tinh, gốm sứ, hàng dễ vỡ</option>
                    <option value="dientu" selected>Đồ điện tử, điện lạnh, đồ công nghệ</option>
                    <option value="sach" selected>Sách & Văn phòng phẩm</option>
                    <option value="quanao" selected>Quần áo, giày túi, bỉm tã</option>
                    <option value="giadung" selected>Đồ gia dụng</option>
                    <option value="khac" selected>Khác</option>
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
                <button class="btn-lg">Tạo đơn hàng</button>
            </div>
        </div>
    </form>
    <script>
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
                        targetElement.innerHTML = ""; // Xóa tất cả các option hiện tại trong hộp chọn
                        data.forEach(function(item) {
                            var option = document.createElement("option");
                            option.value = item.id;
                            option.text = item.name;
                            targetElement.appendChild(option); // Thêm option mới vào hộp chọn
                        });
                    })
                    .catch(error => {
                        console.error("Fetch error:", error);
                    });
            } else {
                var targetElement = document.getElementById(targetId);
                targetElement.innerHTML = ""; // Xóa tất cả các option hiện tại trong hộp chọn
                var option = document.createElement("option");
                option.value = "";
                option.text = "Chọn quận huyện";
                targetElement.append(option);
            }
        });
    }

    // Sử dụng hàm UpdateSelect
    UpdateSelect("province", "http://127.0.0.1/smartShip/api/district?provinceId=", "district");
    UpdateSelect("district", "http://127.0.0.1/smartShip/api/ward?districtId=", "wards");
    </script>
</div>