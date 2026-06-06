<?php 
// 1. Kết nối database và gọi thanh menu giao diện
include 'config/db.php';     
include 'includes/header.php'; 

$error = "";

// 2. Xử lý logic khi người dùng bấm nút "Xác Nhận Thêm"
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_phong = $conn->real_escape_string($_POST['ten_phong']);
    $loai_phong = $conn->real_escape_string($_POST['loai_phong']);
    $suc_chua = intval($_POST['suc_chua']);
    $gia_phong = floatval($_POST['gia_phong']);
    
    // Kiểm tra xem tên phòng này đã tồn tại trong hệ thống chưa để tránh trùng lặp
    $check_trung = $conn->query("SELECT id FROM phong WHERE ten_phong = '$ten_phong'");
    
    if ($check_trung->num_rows > 0) {
        $error = "Tên phòng <strong>$ten_phong</strong> này đã tồn tại trên hệ thống! Vui lòng đặt tên khác.";
    } else {
        // Mặc định phòng mới tạo sẽ có 0 người ở
        $sql_insert = "INSERT INTO phong (ten_phong, loai_phong, suc_chua, so_nguoi_o, gia_phong) 
                       VALUES ('$ten_phong', '$loai_phong', $suc_chua, 0, $gia_phong)";
                       
        if ($conn->query($sql_insert) === TRUE) {
            // Thông báo thành công và chuyển hướng về trang danh sách
            echo "<script>
                    alert('Thêm phòng mới thành công!'); 
                    window.location.href='danh-sach-phong.php';
                  </script>";
            exit();
        } else {
            $error = "Lỗi hệ thống: " . $conn->error;
        }
    }
}
?>

<!-- 3. Giao diện Form Thêm Mới (Sử dụng Bootstrap 5 đồng bộ) -->
<div class="container-fluid d-flex justify-content-center py-4">
    <div class="card border-0 shadow-sm w-100" style="max-width: 600px;">
        <div class="card-header bg-primary text-white fw-bold py-3">
            <i class="fa-solid fa-circle-plus me-2"></i>THÊM PHÒNG KÍ TÚC XÁ MỚI
        </div>
        <div class="card-body p-4">
            
            <!-- Hiển thị thông báo lỗi nếu trùng tên phòng -->
            <?php if($error != ""): ?>
                <div class="alert alert-danger py-2 fs-7">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                
                <!-- Ô nhập Tên Phòng -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Tên Phòng</label>
                    <input type="text" name="ten_phong" class="form-control form-control-lg fw-bold text-dark" 
                           placeholder="Ví dụ: P105, P205..." required>
                </div>
                
                <!-- Ô chọn Loại Phòng -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Loại Phòng (Dành cho)</label>
                    <select name="loai_phong" class="form-select form-control-lg">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>
                
                <!-- Ô nhập Sức Chứa -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Sức Chứa Tối Đa (Người / Phòng)</label>
                    <input type="number" name="suc_chua" class="form-control" value="4" min="1" required>
                </div>
                
                <!-- Ô nhập Giá Phòng -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Giá Phòng / Tháng (VNĐ)</label>
                    <input type="number" name="gia_phong" class="form-control form-control-lg text-success fw-bold" 
                           placeholder="Nhập số tiền gốc..." min="0" step="1000" required>
                </div>
                
                <!-- Các nút điều hướng -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="danh-sach-phong.php" class="btn btn-light border px-4">
                        <i class="fa-solid fa-arrow-left me-1"></i> Hủy Bỏ
                    </a>
                    <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Xác Nhận Thêm
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