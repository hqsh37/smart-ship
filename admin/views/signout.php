<?php
// unset session variable
unset($_SESSION['admin']);

echo '<script>
alert("Đăng xuất thành công!");
window.location.href = "'.PROJECT_NAME.'/admin/login.php";
</script>';