<?php
$conn = new mysqli("localhost", "root", "", "quanly_ktx");
if ($conn->connect_error) {
    die("Kết nối database thất bại: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>