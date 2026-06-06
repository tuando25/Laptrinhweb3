<?php 
// 1. Kết nối database và gọi thanh menu giao diện
include 'config/db.php';     
include 'includes/header.php'; 

// 2. Lấy ID phòng từ đường dẫn URL (Ví dụ: sua-phong.php?id=1)
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Bảo mật ID dạng số
    
    // Lấy thông tin hiện tại của phòng đó từ Database
    $result = $conn->query("SELECT * FROM phong WHERE id = $id");
    
    if ($result->num_rows > 0) {
        $phong = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger m-3'>Không tìm thấy phòng này trong hệ thống!</div>";
        include 'includes/footer.php';
        exit();
    }
} else {
    echo "<div class='alert alert-danger m-3'>Thiếu ID phòng cần sửa!</div>";
    include 'includes/footer.php';
    exit();
}

// 3. Xử lý logic khi người dùng nhấn nút "Lưu Cập Nhật"
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_phong = $conn->real_escape_string($_POST['ten_phong']);
    $loai_phong = $conn->real_escape_string($_POST['loai_phong']);
    $suc_chua = intval($_POST['suc_chua']);
    $gia_phong = floatval($_POST['gia_phong']);
    
    // Câu lệnh SQL cập nhật dữ liệu
    $sql_update = "UPDATE phong SET 
                    ten_phong = '$ten_phong', 
                    loai_phong = '$loai_phong', 
                    suc_chua = $suc_chua, 
                    gia_phong = $gia_phong 
                   WHERE id = $id";
                   
    if ($conn->query($sql_update) === TRUE) {
        // Thông báo thành công bằng Javascript và tự chuyển hướng về trang danh sách phòng
        echo "<script>
                alert('Cập nhật thông tin phòng thành công!'); 
                window.location.href='danh-sach-phong.php';
              </script>";
        exit();
    } else {
        echo "<div class='alert alert-danger m-3'>Lỗi khi cập nhật: " . $conn->error . "</div>";
    }
}
?>

<!-- 4. Giao diện Form Chỉnh Sửa (Sử dụng Bootstrap 5) -->
<div class="container-fluid d-flex justify-content-center py-4">
    <div class="card border-0 shadow-sm w-100" style="max-width: 600px;">
        <div class="card-header bg-warning text-dark fw-bold py-3">
            <i class="fa-solid fa-pen-to-square me-2"></i>CHỈNH SỬA THÔNG TIN PHÒNG
        </div>
        <div class="card-body p-4">
            <form action="" method="POST">
                
                <!-- Ô nhập Tên Phòng -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Tên Phòng</label>
                    <input type="text" name="ten_phong" class="form-control form-control-lg fw-bold text-dark" 
                           value="<?php echo htmlspecialchars($phong['ten_phong']); ?>" required>
                </div>
                
                <!-- Ô chọn Loại Phòng -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Loại Phòng (Dành cho)</label>
                    <select name="loai_phong" class="form-select form-control-lg">
                        <option value="Nam" <?php if($phong['loai_phong'] == 'Nam') echo 'selected'; ?>>Nam</option>
                        <option value="Nữ" <?php if($phong['loai_phong'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                    </select>
                </div>
                
                <!-- Ô nhập Sức Chứa -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Sức Chứa Tối Đa (Người)</label>
                    <input type="number" name="suc_chua" class="form-control" 
                           value="<?php echo intval($phong['suc_chua']); ?>" min="1" required>
                    <small class="text-muted">* Hiện tại đang có <strong><?php echo $phong['so_nguoi_o']; ?></strong> người ở phòng này.</small>
                </div>
                
                <!-- Ô nhập Giá Phòng -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Giá Phòng / Tháng (VNĐ)</label>
                    <input type="number" name="gia_phong" class="form-control form-control-lg text-success fw-bold" 
                           value="<?php echo (int)$phong['gia_phong']; ?>" min="0" step="1000" required>
                </div>
                
                <!-- Các nút điều hướng -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="danh-sach-phong.php" class="btn btn-light border px-4">
                        <i class="fa-solid fa-arrow-left me-1"></i> Quay Lại
                    </a>
                    <button type="submit" class="btn btn-warning fw-bold text-dark px-4 shadow-sm">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Lưu Cập Nhật
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>

<?php 
// Gọi file chân trang giao diện
include 'includes/footer.php'; 
?>