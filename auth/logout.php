<?php
include "../config.php";
// destroy session
session_destroy();

echo '<script>
alert("Đăng xuất thành công!");
window.location.href = "'.PROJECT_NAME.'/auth/login.php";
</script>';