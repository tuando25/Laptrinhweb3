<?php
session_start();
session_destroy(); // Xóa bỏ toàn bộ bộ nhớ phiên đăng nhập
header("Location: login.php"); // Quay về trang đăng nhập
exit();
?>