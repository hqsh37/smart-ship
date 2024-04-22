<div class="container">
    <div class="head-address">
        <h2 class="add-title">Địa chỉ của tôi</h2>

        <!-- Button trigger modal -->
        <button type="button" class="btn-create-product" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Thêm địa chỉ
        </button>
    </div>
    <div class="label">
        <h4>Địa chỉ</h4>
    </div>

    <div class="wrap-add">
        <div class="content cus-vien">
            <div class="add-content">
                <div class="usr-info">
                    <span class="usr-fullname">
                        Hoàng Quahg Sang
                    </span>
                    <div class="space-usr">|</div>
                    <div class="usr-phone">(+84) 907322495</div>
                </div>
                <div class="usr-addr">
                    <div class="add-more">27 Vườn Lài</div>
                    <div class="add-main">Phường An Phú Đông, Quận 12, TP. Hồ Chí Minh</div>
                </div>
            </div>

            <div class="field-btn">
                <button class="updateButton">Cập nhật</button>
            </div>
        </div>

        <div class="content cus-vien">
            <div class="add-content">
                <div class="usr-info">
                    <span class="usr-fullname">
                        Hoàng Quahg Sang
                    </span>
                    <div class="space-usr">|</div>
                    <div class="usr-phone">(+84) 907322495</div>
                </div>
                <div class="usr-addr">
                    <div class="add-more">27 Vườn Lài</div>
                    <div class="add-main">Phường An Phú Đông, Quận 12, TP. Hồ Chí Minh</div>
                </div>
            </div>

            <div class="field-btn">
                <button class="updateButton">Cập nhật</button>
            </div>
        </div>

        <div class="content cus-vien">
            <div class="add-content">
                <div class="usr-info">
                    <span class="usr-fullname">
                        Hoàng Quahg Sang
                    </span>
                    <div class="space-usr">|</div>
                    <div class="usr-phone">(+84) 907322495</div>
                </div>
                <div class="usr-addr">
                    <div class="add-more">27 Vườn Lài</div>
                    <div class="add-main">Phường An Phú Đông, Quận 12, TP. Hồ Chí Minh</div>
                </div>
            </div>

            <div class="field-btn">
                <button class="updateButton">Cập nhật</button>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm địa chỉ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="txt-name">Tên người gửi</label>
                        <input type="text" class="form-control" id="txt-name" placeholder="Nhập tên người gửi">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Thêm</button>
                </div>
            </div>
        </div>
    </div>
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
    promise.then(function(result) {
        renderCity(result.data);
    });

    function renderCity(data) {
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