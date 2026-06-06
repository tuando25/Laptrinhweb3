<?php 
include 'config/db.php';     
include 'includes/header.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM sinh_vien WHERE id = $id");
    $sv = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_sv = $_POST['ma_sv'];
    $ho_ten = $_POST['ho_ten'];
    $gioi_tinh = $_POST['gioi_tinh'];
    $id_phong = $_POST['id_phong'] == '' ? 'NULL' : $_POST['id_phong'];
    
    $sql_update = "UPDATE sinh_vien SET 
                    ma_sv = '$ma_sv', 
                    ho_ten = '$ho_ten', 
                    gioi_tinh = '$gioi_tinh', 
                    id_phong = $id_phong 
                   WHERE id = $id";
                   
    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Cập nhật sinh viên thành công!'); window.location.href='danh-sach-sv.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Lấy danh sách phòng để hiển thị ra ô Chọn phòng
$phongs = $conn->query("SELECT id, ten_phong FROM phong");
?>

<div class="container-fluid" style="max-width: 600px;">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning text-dark fw-bold py-3">
            <i class="fa-solid fa-user-pen me-2"></i>Chỉnh Sửa Thông Tin Sinh Viên
        </div>
        <div class="card-body p-4">
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Mã Sinh Viên</label>
                    <input type="text" name="ma_sv" class="form-control" value="<?php echo $sv['ma_sv']; ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Họ và Tên</label>
                    <input type="text" name="ho_ten" class="form-control" value="<?php echo $sv['ho_ten']; ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Giới Tính</label>
                    <select name="gioi_tinh" class="form-select">
                        <option value="Nam" <?php if($sv['gioi_tinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                        <option value="Nữ" <?php if($sv['gioi_tinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Xếp Vào Phòng</label>
                    <select name="id_phong" class="form-select">
                        <option value="">-- Chưa xếp phòng --</option>
                        <?php while($p = $phongs->fetch_assoc()): ?>
                            <option value="<?php echo $p['id']; ?>" <?php if($sv['id_phong'] == $p['id']) echo 'selected'; ?>>
                                Phòng <?php echo $p['ten_phong']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="danh-sach-sv.php" class="btn btn-light border">Quay Lại</a>
                    <button type="submit" class="btn btn-warning fw-bold text-dark">Lưu Cập Nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>