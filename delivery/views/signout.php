<?php
// unset session variable
unset($_SESSION['delivery']);

echo '<script>
alert("Đăng xuất thành công!");
window.location.href = "'.PROJECT_NAME.'/auth/employee-login.php";
</script>';