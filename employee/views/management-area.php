<?php
$urlpath = $this->geturl("management-area");
$postOfficeId = $_SESSION["employee"]->idBuuCuc;

if (isset($_POST['btnAdd'])) {
    $province = $_POST['province'];
    $district = $_POST['district'];
    // `id`, `idBuuCuc`, `province`, `district` 
    $addArea = Area::create([
        "idBuuCuc" => $postOfficeId,
        "province" => $province,
        "district" => $district,
    ]);

    if ($addArea) {
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

if (isset($_POST['btnRemove'])) {
    $id = $_POST['id'];

    $delArea = Area::delete([
        "id" => $id,
    ]);

    if ($delArea) {
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

$area = Area::finds([
    "idBuuCuc" => $postOfficeId,
]);

$tt = 1;
?>

<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Khu vực quản lý</h3>
                <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#addArea">
                    Thêm
                </button>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>TT</th>
                            <th>Huyện/Quận</th>
                            <th>Tỉnh/Thành phố</th>
                            <th>Hành động</th>
                        </tr>
                        <?php foreach ($area as $item) : ?>
                        <?php
                            $districtName = District::find([
                                "district_id" => $item->district,
                            ])->name;
                            $provinceName = Province::find([
                                "province_id" => $item->province,
                            ])->name;
                            ?>
                        <tr>
                            <td><?php echo $tt++; ?></td>
                            <td><?php echo $districtName; ?></td>
                            <td><?php echo $provinceName; ?></td>
                            <td><button type="button" data-toggle="modal"
                                    data-target="#removeArea<?php echo $item->id ?>">Xoá</button></td>
                        </tr>
                        <!-- modal Remove Area -->
                        <div class="modal fade" id="removeArea<?php echo $item->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="<?php echo $urlpath ?>" method="POST">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Thông báo</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div style="display: none">
                                                <input name="id" value="<?php echo $item->id; ?>">
                                            </div>
                                            <p>Bạn có chắc xoá khu vục này!</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" name="btnRemove" class="btn btn-default">Xác nhận</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- modal add Area -->
    <div class="modal fade" id="addArea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?php echo $urlpath ?>" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Thêm khu vực</h4>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="form-group">
                                <label for="province">Tỉnh/Thành phố</label>
                                <div>
                                    <div class="col-md-6">
                                        <select id="province" name="province" class="form-control" required>
                                            <option value="">Chọn một tỉnh</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control" id="district" name="district" required>
                                            <option value="" selected>Chọn quận huyện</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="btnAdd" class="btn btn-default">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

// address reciever 
UpdateSelectProvice("<?php echo  API_URL ?>/province.php", "province", 1);
UpdateSelect("province", "<?php echo API_URL ?>/district.php?provinceId=", "district");
</script>