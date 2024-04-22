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
                    <label for="city">Địa chỉ</label>
                    <div class="col">
                        <select class="form-control" id="city">
                            <option value="" selected>Chọn tỉnh thành</option>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-control" id="district">
                            <option value="" selected>Chọn quận huyện</option>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-control" id="ward">
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
                <input type="text" class="form-control" id="txt-name" placeholder="Nhập tên người nhận">
            </div>
            <div class="row">
                <div class="col">
                    <label for="txt-sdt">Khối lượng</label>
                    <input type="text" class="form-control" id="txt-sdt" placeholder="Nhập số điện thoại">
                </div>
                <div class="col">
                    <label for="txt-address">Số lượng</label>
                    <input type="text" class="form-control" id="txt-address" placeholder="Nhập địa chỉ tiết">
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
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Hàng dễ vỡ
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Hàng giá trị cao
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Thư tín tài liệu
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Hàng chất lỏng
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Hàng có HSD ngắn
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Hàng có cạnh sắc nhọn
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Nông sản, thực phẩm khô
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then((result) => {
        renderCity(result.data);
    });

    const renderCity = (data) => {
        for (const x of data) {
            var opt = document.createElement('option');
            opt.value = x.Name;
            opt.text = x.Name;
            opt.setAttribute('data-id', x.Id);
            citis.options.add(opt);
        }
        citis.onchange = function() {
            district.length = 1;
            ward.length = 1;
            if (this.options[this.selectedIndex].dataset.id != "") {
                const result = data.filter(n => n.Id === this.options[this.selectedIndex].dataset.id);

                for (const k of result[0].Districts) {
                    var opt = document.createElement('option');
                    opt.value = k.Name;
                    opt.text = k.Name;
                    opt.setAttribute('data-id', k.Id);
                    district.options.add(opt);
                }
            }
        };
        district.onchange = function() {
            ward.length = 1;
            const dataCity = data.filter((n) => n.Id === citis.options[citis.selectedIndex].dataset.id);
            if (this.options[this.selectedIndex].dataset.id != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Id === this.options[this.selectedIndex]
                    .dataset.id)[0].Wards;

                for (const w of dataWards) {
                    var opt = document.createElement('option');
                    opt.value = w.Name;
                    opt.text = w.Name;
                    opt.setAttribute('data-id', w.Id);
                    wards.options.add(opt);
                }
            }
        };
    }
    </script>
</div>