<?php
include 'config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Thực hiện câu lệnh xóa phòng dựa vào ID
    $sql = "DELETE FROM phong WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        // Xóa thành công, chuyển hướng về lại trang danh sách phòng
        header("Location: danh-sach-phong.php");
        exit();
    } else {
        echo "Lỗi khi xóa phòng: " . $conn->error;
    }
}
?>