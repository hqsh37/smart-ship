<div class="container">
    <form id="myForm" class="mt-5" method="POST">
        <h1 class="py-5">Chọn địa chỉ khi đặt hàng trong website</h1>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="province">Tỉnh/Thành phố</label>
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
                <div class="form-group">
                    <label for="district">Quận/Huyện</label>
                    <select id="district" name="district" class="form-control">
                        <option value="">Chọn một quận/huyện</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="wards">Phường/Xã</label>
                    <select id="wards" name="wards" class="form-control">
                        <option value="">Chọn một xã</option>
                    </select>
                </div>
                <input type="submit" name="add_sale" class="btn btn-primary w-100 form-input my-3" value="Đặt hàng">

            </div>
        </div>
    </form>
</div>

<script>
function fetchAndUpdateSelect(elementId, url, targetId) {
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
            targetElement.innerHTML = ""; // Xóa tất cả các option trong hộp chọn
        }
    });
}

// Sử dụng hàm fetchAndUpdateSelect để tái sử dụng mã
fetchAndUpdateSelect("province", "http://127.0.0.1/smartShip/api/district?provinceId=", "district");
fetchAndUpdateSelect("district", "http://127.0.0.1/smartShip/api/ward?districtId=", "wards");

</script>