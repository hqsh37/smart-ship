<?php
$idKH = 1;
$address =  AddressUser::finds([
    "idKH" => $idKH,
]);

$urlpath = $this->geturl("address-user");
$disDel = "style=\"display: none\"";
if (isset($_POST["type"]) && $_POST["type"] === "add-address") {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $province = $_POST["province"];
    $district = $_POST["district"];
    $wards = $_POST["wards"];
    // `idKH`, `tenKH`, `phone`, `address`, `province`, `district`, `wards`,

    $resultAdd = AddressUser::create([
        "idKH" => $idKH,
        "tenKH" => $name,
        "phone" => $phone,
        "address" => $address,
        "province" => $province,
        "district" => $district,
        "wards" => $wards,
    ]);

    if($resultAdd) {
        echo '<script>
            alert("Thêm thành công!");
            window.location.href = "'.$urlpath.'";
            </script>';
    } else {
        echo '<script>
            alert("Thêm thất bại!")
            window.location.href = "'.$urlpath.'";
            </script>';
    }
}

// Update address customer
if (isset($_POST["type"]) && $_POST["type"] === "update-address") {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $province = $_POST["province"];
    $district = $_POST["district"];
    $wards = $_POST["wards"];
    $addresskhId = $_POST["idAddressKH"];
    // `idKH`, `tenKH`, `phone`, `address`, `province`, `district`, `wards`,

    $resultUp = AddressUser::update([
        "idDiaChiKH" => $addresskhId,
    ], [
        "tenKH" => $name,
        "phone" => $phone,
        "address" => $address,
        "province" => $province,
        "district" => $district,
        "wards" => $wards,
    ]);

    if($resultUp) {
        echo '<script>
            alert("Sửa thành công!");
            window.location.href = "'.$urlpath.'";
            </script>';
    } else {
        echo '<script>
            alert("Sửa thất bại!")
            window.location.href = "'.$urlpath.'";
            </script>';
    }
}

// Update address customer
if (isset($_POST["type"]) && $_POST["type"] === "del-address") {
    $addresskhId = $_POST["idAddressKH"];

    $resultDel = AddressUser::delete([
        "idDiaChiKH" => $addresskhId,
    ]);

    if($resultDel) {
        echo '<script>
            alert("Xoá thành công!");
            window.location.href = "'.$urlpath.'";
            </script>';
    } else {
        echo '<script>
            alert("Xoá thất bại!")
            window.location.href = "'.$urlpath.'";
            </script>';
    }
}
?>

<div class="container">
    <div class="head-address">
        <h2 class="add-title">Địa chỉ của tôi</h2>

        <!-- Button trigger modal -->
        <button type="button" class="btn-create-product" data-bs-toggle="modal" data-bs-target="#add-address-modal">
            Thêm địa chỉ
        </button>
    </div>
    <div class="label">
        <h4>Địa chỉ</h4>
    </div>

    <div class="wrap-add">
    <?php if (isset($address) && is_array($address)) : ?>
        <?php foreach ($address as $addr) : ?>
        <div class="content cus-vien">
            <div class="add-content">
                <div class="usr-info">
                    <span class="usr-fullname">
                        <?php echo $addr->tenKH; ?>
                    </span>
                    <div class="space-usr">|</div>
                    <div class="usr-phone"><?php echo $addr->phone; ?></div>
                </div>
                <div class="usr-addr">
                    <div class="add-more"><?php echo $addr->address; ?></div>
                    <div class="add-main"><?php echo $addr->wardName; ?>, <?php echo $addr->districtName; ?>.
                        <?php echo $addr->provinceName; ?></div>
                </div>
            </div>

            <div class="field-btn">
                <button class="updateButton" data-bs-toggle="modal"
                    data-bs-target="#update-address-<?php echo $addr->idDiaChiKH; ?>">Cập nhật</button>
                <button class="delButton" <?php echo $disDel; $disDel ="";?> data-bs-toggle="modal"
                    data-bs-target="#xoa-address-<?php echo $addr->idDiaChiKH; ?>">Xoá</button>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

    </div>


    <!-- Modal address update -->



    <!-- Modal thêm -->
    <div class="modal fade" id="add-address-modal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="add-address-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="<?php echo $urlpath; ?>" method="post">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add-address-modalLabel">Thêm địa chỉ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div style="display: none;"><input type="text" name="type" value="add-address"></div>
                        <div class="form-group">
                            <label for="txt-name">Tên người gửi</label>
                            <input type="text" class="form-control" id="txt-name" name="name"
                                placeholder="Nhập tên người gửi" required>
                        </div>
                        <div class="form-group">
                            <label for="txt-sdt">Số điện thoại</label>
                            <input type="text" class="form-control" id="txt-sdt" name="phone"
                                placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="form-group">
                            <label for="txt-address">Địa chỉ chi tiết</label>
                            <input type="text" class="form-control" id="txt-address" name="address"
                                placeholder="Nhập địa chỉ tiết" required>
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <?php
    if(isset($address) && is_array($address)) {
        foreach ($address as $item) {
            handleModalUpdate($urlpath, $item->tenKH, $item->phone, $item->address, $item->wardName, $item->districtName, $item->provinceName, $item->wards, $item->district, $item->province, $item->idDiaChiKH);
        }
    }
    ?>

    <?php
    // handle view update function
    function handleModalUpdate($urlpath, $name, $phone, $address, $wardName, $districtName, $provinceName, $wardId, $districtId, $provinceId, $id) {
        $viewUpdateAddress = "<div class=\"modal fade\" id=\"update-address-{$id}\" data-bs-backdrop=\"static\" tabindex=\"-1\"
            aria-labelledby=\"update-address-Label\" aria-hidden=\"true\">
            <div class=\"modal-dialog modal-lg\">
                <form action=\"".$urlpath."\" method=\"post\">

                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h5 class=\"modal-title\" id=\"update-address-Label-{$id}\">Thêm địa chỉ</h5>
                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                        </div>
                        <div class=\"modal-body\">
                            <div style=\"display: none;\"><input type=\"text\" name=\"type\" value=\"update-address\"></div>
                            <div style=\"display: none;\"><input type=\"text\" name=\"idAddressKH\" value=\"{$id}\"></div>
                            <div class=\"form-group\">
                                <label for=\"txt-name-{$id}\">Tên người gửi</label>
                                <input type=\"text\" class=\"form-control\" id=\"txt-name-{$id}\" name=\"name\" placeholder=\"Nhập tên người gửi\" value=\"{$name}\"
                                    required>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"txt-sdt-{$id}\">Số điện thoại</label>
                                <input type=\"text\" class=\"form-control\" id=\"txt-sdt-{$id}\" name=\"phone\" placeholder=\"Nhập số điện thoại\" value=\"{$phone}\"
                                    required>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"txt-address-{$id}\">Địa chỉ chi tiết</label>
                                <input type=\"text\" class=\"form-control\" id=\"txt-address-{$id}\" name=\"address\" placeholder=\"Nhập địa chỉ tiết\" value=\"{$address}\"
                                    required>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"row\">
                                    <label for=\"province-{$id}\">Tỉnh/Thành phố</label>
                                    <div class=\"col\">
                                        <select id=\"province-{$id}\" name=\"province\" class=\"form-control\" required>
                                            <option value=\"{$provinceId}\">{$provinceName}</option>
                                        </select>
                                    </div>
                                    <div class=\"col\">
                                        <select class=\"form-control\" id=\"district-{$id}\" name=\"district\" required>
                                            <option value=\"{$districtId}\" selected>{$districtName}</option>
                                        </select>
                                    </div>
                                    <div class=\"col\">
                                        <select class=\"form-control\" id=\"wards-{$id}\" name=\"wards\" required>
                                            <option value=\"{$wardId}\" selected>{$wardName}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Đóng</button>
                            <button type=\"submit\" class=\"btn btn-primary\">Sửa</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>";

        $viewDelAddress = "<div class=\"modal fade\" id=\"xoa-address-{$id}\" tabindex=\"-1\" aria-labelledby=\"xoa-address-{$id}-Label\" aria-hidden=\"true\">
            <div class=\"modal-dialog\">
            <form action=\"".$urlpath."\" method=\"post\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                    <h5 class=\"modal-title\" id=\"xoa-address-{$id}-Label\">Thông báo</h5>
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                    </div>
                    <div class=\"modal-body\">
                    <div style=\"display: none;\"><input type=\"text\" name=\"type\" value=\"del-address\"></div>
                    <div style=\"display: none;\"><input type=\"text\" name=\"idAddressKH\" value=\"{$id}\"></div>
                    <p>Bạn có chắc muốn xoá địa chỉ này không!</p>
                    </div>
                    <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Huỷ</button>
                    <button type=\"submit\" class=\"btn btn-primary\">Xác nhận</button>
                    </div>
                </div>
            </form>
            </div>
        </div>";

        echo $viewDelAddress;
        echo $viewUpdateAddress;
        
    }
    
    ?>
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
                }
            })
        }
    }


    // Sử dụng hàm UpdateSelect
    UpdateSelect("province", "<?php echo API_URL ?>/district.php?provinceId=", "district");
    UpdateSelect("district", "<?php echo API_URL ?>/ward.php?districtId=", "wards");
    UpdateSelectProvice("<?php echo API_URL ?>/province.php", "province", 1);
    <?php foreach($address as $item) : ?>
    UpdateSelect("province-<?php echo $item->idDiaChiKH; ?>", "<?php echo API_URL ?>/district.php?provinceId=", "district-<?php echo $item->idDiaChiKH; ?>");
    UpdateSelect("district-<?php echo $item->idDiaChiKH; ?>", "<?php echo API_URL ?>/ward.php?districtId=", "wards-<?php echo $item->idDiaChiKH; ?>");
    UpdateSelectProvice("<?php echo API_URL ?>/province.php", "province-<?php echo $item->idDiaChiKH; ?>", 0);
    <?php endforeach; ?>

    </script>
</div>