<div class="user-info">
    <div class="container">
        <h2 class="info-title">Thông tin cá nhân</h2>
        <div class="wrap-content">
            <div class="content">
                <h3 class="content-label">Họ tên</h3>
                <div class="content-input">
                    <input type="text" class="form-control" id="txt-name" placeholder="Nhập họ tên"
                        value="Hoàng Quang Sang" disabled>
                    <!-- <div class="content-description">
                        <p></p>
                    </div> -->
                </div>
            </div>
            <div class="field-btn">

                <button class="updateButton">Cập nhật</button>
                <div class="update-section">
                    <button class="update-dc">Lưu</button>
                    <button class="cancelButton">Thoát</button>
                </div>
            </div>
        </div>
        <div class="wrap-content">
            <div class="content">
                <h3 class="content-label">Email</h3>
                <div class="content-input">
                    <input type="text" class="form-control" id="txt-name" placeholder="Nhập email"
                        value="hqwsh37@gmail.com" disabled>
                    <!-- <div class="content-description">
                        <p></p>
                    </div> -->
                </div>
            </div>
            <div class="field-btn">

                <button class="updateButton">Cập nhật</button>
                <div class="update-section">
                    <button class="update-dc">Lưu</button>
                    <button class="cancelButton">Thoát</button>
                </div>
            </div>
        </div>
        <div class="wrap-content">
            <div class="content">
                <h3 class="content-label">Số điện thoại</h3>
                <div class="content-input">
                    <input type="text" class="form-control" id="txt-name" placeholder="Nhập số điện thoại"
                        value="0328435442" disabled>
                    <!-- <div class="content-description">
                        <p></p>
                    </div> -->
                </div>
            </div>
            <div class="field-btn">

                <button class="updateButton">Cập nhật</button>
                <div class="update-section">
                    <button class="update-dc">Lưu</button>
                    <button class="cancelButton">Thoát</button>
                </div>
            </div>
        </div>
        <div class="wrap-content">
            <div class="content">
                <h3 class="content-label">Họ tên</h3>
                <div class="content-input">
                    <input type="text" class="form-control" id="txt-name" placeholder="Nhập họ tên"
                        value="Hoàng Quang Sang" disabled>
                    <!-- <div class="content-description">
                        <p></p>
                    </div> -->
                </div>
            </div>
            <div class="field-btn">

                <button class="updateButton">Cập nhật</button>
                <div class="update-section">
                    <button class="update-dc">Lưu</button>
                    <button class="cancelButton">Thoát</button>
                </div>
            </div>
        </div>

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