<?php 
// 1. Kết nối database và gọi menu giao diện
include 'config/db.php';     
include 'includes/header.php'; 

// 2. Xử lý khi người dùng bấm nút "Lập Hóa Đơn" (Gửi dữ liệu qua POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_phong = intval($_POST['id_phong']);
    $thang_nam = $conn->real_escape_string($_POST['thang_nam']);
    $tien_phong = floatval($_POST['tien_phong']);
    $tien_dien = floatval($_POST['tien_dien']);
    $tien_nuoc = floatval($_POST['tien_nuoc']);
    
    // Tự động tính tổng tiền bằng tổng 3 khoản cộng lại
    $tong_tien = $tien_phong + $tien_dien + $tien_nuoc;
    $trang_thai = 'Chưa thanh toán'; // Hóa đơn mới lập mặc định là chưa thanh toán

    // Câu lệnh SQL chèn hóa đơn mới vào Database
    $sql_insert = "INSERT INTO hoa_don (id_phong, thang_nam, tien_phong, tien_dien, tien_nuoc, tong_tien, trang_thai) 
                   VALUES ($id_phong, '$thang_nam', $tien_phong, $tien_dien, $tien_nuoc, $tong_tien, '$trang_thai')";
                   
    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>
                alert('Lập hóa đơn mới thành công!'); 
                window.location.href='danh-sach-hoa-don.php';
              </script>";
        exit();
    } else {
        echo "<div class='alert alert-danger m-3'>Lỗi khi lập hóa đơn: " . $conn->error . "</div>";
    }
}

// 3. Lấy danh sách tất cả các phòng để hiển thị vào ô lựa chọn (Dropdown)
$phongs = $conn->query("SELECT id, ten_phong, gia_phong FROM phong ORDER BY ten_phong ASC");
?>

<div class="container-fluid d-flex justify-content-center py-4">
    <div class="card border-0 shadow-sm w-100" style="max-width: 650px;">
        <div class="card-header bg-primary text-white fw-bold py-3">
            <i class="fa-solid fa-file-invoice-dollar me-2"></i>LẬP HÒA ĐƠN ĐIỆN NƯỚC MỚI
        </div>
        <div class="card-body p-4">
            <form action="" method="POST">
                
                <!-- Ô chọn Phòng ktx -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Chọn Phòng</label>
                    <select name="id_phong" id="id_phong" class="form-select form-control-lg" required onchange="capNhatGiaPhong()">
                        <option value="">-- Chọn phòng cần lập hóa đơn --</option>
                        <?php while($p = $phongs->fetch_assoc()): ?>
                            <!-- Lưu kèm thuộc tính data-gia để Javascript tự động điền số tiền -->
                            <option value="<?php echo $p['id']; ?>" data-gia="<?php echo (int)$p['gia_phong']; ?>">
                                Phòng <?php echo htmlspecialchars($p['ten_phong']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Ô chọn Tháng/Năm lập hóa đơn -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Hóa Đơn Cho Tháng / Năm</label>
                    <input type="month" name="thang_nam" class="form-control" value="<?php echo date('Y-m'); ?>" required>
                </div>
                
                <hr class="my-4 text-muted">

                <!-- Ô nhập Tiền Phòng -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Tiền Phòng gốc (VNĐ)</label>
                    <input type="number" name="tien_phong" id="tien_phong" class="form-control fw-bold text-dark" min="0" required>
                    <small class="text-muted">* Số tiền này sẽ tự điền khi bạn chọn phòng ở trên.</small>
                </div>
                
                <!-- Ô nhập Tiền Điện -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Tiền Điện Thao Tác (VNĐ)</label>
                    <input type="number" name="tien_dien" class="form-control text-danger fw-bold" min="0" value="0" required>
                </div>
                
                <!-- Ô nhập Tiền Nước -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Tiền Nước Thao Tác (VNĐ)</label>
                    <input type="number" name="tien_nuoc" class="form-control text-info fw-bold" min="0" value="0" required>
                </div>
                
                <!-- Các nút hành động -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="danh-sach-hoa-don.php" class="btn btn-light border px-4">
                        <i class="fa-solid fa-arrow-left me-1"></i> Hủy Bỏ
                    </a>
                    <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Xác Nhận Lập Hóa Đơn
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>

<!-- 4. Đoạn mã Javascript thông minh tự lấy giá tiền phòng điền vào ô nhập liệu -->
<script>
function capNhatGiaPhong() {
    var select = document.getElementById("id_phong");
    var selectedOption = select.options[select.selectedIndex];
    
    // Lấy giá phòng được giấu trong thuộc tính data-gia
    var giaPhong = selectedOption.getAttribute("data-gia");
    
    // Điền số tiền đó vào ô nhập tiền phòng
    if(giaPhong) {
        document.getElementById("tien_phong").value = giaPhong;
    } else {
        document.getElementById("tien_phong").value = "";
    }
}
</script>

<?php 
include 'includes/footer.php'; 
?>