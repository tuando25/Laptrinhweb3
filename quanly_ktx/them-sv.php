<?php 
include 'config/db.php';     
include 'includes/header.php'; 

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_sv = $conn->real_escape_string($_POST['ma_sv']);
    $ho_ten = $conn->real_escape_string($_POST['ho_ten']);
    $gioi_tinh = $conn->real_escape_string($_POST['gioi_tinh']);
    $id_phong = $_POST['id_phong'] == '' ? 'NULL' : intval($_POST['id_phong']);
    
    $check_trung = $conn->query("SELECT id FROM sinh_vien WHERE ma_sv = '$ma_sv'");
    
    if ($check_trung->num_rows > 0) {
        $error = "Mã sinh viên <strong>$ma_sv</strong> này đã tồn tại!";
    } else {
        $sql_insert = "INSERT INTO sinh_vien (ma_sv, ho_ten, gioi_tinh, id_phong) VALUES ('$ma_sv', '$ho_ten', '$gioi_tinh', $id_phong)";
        if ($conn->query($sql_insert) === TRUE) {
            if ($id_phong != 'NULL') {
                $conn->query("UPDATE phong SET so_nguoi_o = so_nguoi_o + 1 WHERE id = $id_phong");
            }
            echo "<script>alert('Thêm sinh viên thành công!'); window.location.href='danh-sach-sv.php';</script>";
            exit();
        } else {
            $error = "Lỗi: " . $conn->error;
        }
    }
}

$phongs = $conn->query("SELECT id, ten_phong, so_nguoi_o, suc_chua FROM phong WHERE so_nguoi_o < suc_chua ORDER BY ten_phong ASC");
?>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white fw-bold py-3">
                    <i class="fa-solid fa-user-plus me-2"></i>THÊM SINH VIÊN MỚI
                </div>
                <div class="card-body p-4">
                    
                    <?php if($error != ""): ?>
                        <div class="alert alert-danger py-2 fs-7"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Mã Sinh Viên</label>
                            <input type="text" name="ma_sv" class="form-control" placeholder="Nhập mã SV..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Họ và Tên</label>
                            <input type="text" name="ho_ten" class="form-control" placeholder="Nhập họ tên..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Giới Tính</label>
                            <select name="gioi_tinh" class="form-select">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Xếp Vào Phòng</label>
                            <select name="id_phong" class="form-select">
                                <option value="">-- Chưa xếp phòng --</option>
                                <?php while($p = $phongs->fetch_assoc()): ?>
                                    <option value="<?php echo $p['id']; ?>">Phòng <?php echo $p['ten_phong']; ?> (<?php echo $p['so_nguoi_o']; ?>/<?php echo $p['suc_chua']; ?>)</option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="danh-sach-sv.php" class="btn btn-light border px-4"><i class="fa-solid fa-arrow-left me-1"></i> Hủy</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm"><i class="fa-solid fa-floppy-disk me-1"></i> Lưu lại</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php 
include 'includes/footer.php'; 
?>