<?php
// Kết nối đến cơ sở dữ liệu MySQL trên XAMPP
$conn = new mysqli("localhost", "root", "", "quanly_ktx");

// Kiểm tra nếu kết nối bị lỗi
if ($conn->connect_error) {
    die("Kết nối database thất bại: " . $conn->connect_error);
}

// Cấu hình font tiếng Việt không bị lỗi hiển thị
$conn->set_charset("utf8mb4");
?>