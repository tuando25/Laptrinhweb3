<?php
// 1. Kết nối đến cơ sở dữ liệu
include 'config/db.php';

// 2. Kiểm tra xem có nhận được ID hóa đơn truyền sang không
if (isset($_GET['id'])) {
    $id_hoa_don = intval($_GET['id']); // Chuyển về dạng số để bảo mật
    
    // 3. Câu lệnh SQL cập nhật trạng thái hóa đơn thành 'Đã thanh toán'
    $sql = "UPDATE hoa_don SET trang_thai = 'Đã thanh toán' WHERE id = $id_hoa_don";
    
    if ($conn->query($sql) === TRUE) {
        // Nếu thành công, bật thông báo và tự động quay lại trang danh sách hóa đơn
        echo "<script>
                alert('Xử lý thu tiền thành công!');
                window.location.href = 'danh-sach-hoa-don.php';
              </script>";
        exit();
    } else {
        echo "Lỗi khi cập nhật hóa đơn: " . $conn->error;
    }
} else {
    echo "Không tìm thấy mã hóa đơn hợp lệ!";
}
?>