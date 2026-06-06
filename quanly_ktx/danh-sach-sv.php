<?php 
include 'config/db.php';     
include 'includes/header.php'; 

// Truy vấn lấy danh sách sinh viên và tên phòng tương ứng
$sql = "SELECT sinh_vien.*, phong.ten_phong 
        FROM sinh_vien 
        LEFT JOIN phong ON sinh_vien.id_phong = phong.id";
$result = $conn->query($sql);
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="fa-solid fa-users text-primary me-2"></i>Quản Lý Sinh Viên</h3>
        <a href="them-sv.php" class="btn btn-primary shadow-sm"><i class="fa-solid fa-user-plus me-1"></i> Thêm Sinh Viên</a>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase fs-7 fw-semibold text-secondary">
                        <tr>
                            <th class="ps-4">Mã SV</th>
                            <th>Họ và Tên</th>
                            <th>Giới Tính</th>
                            <th>Phòng Đang Ở</th>
                            <th class="pe-4 text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="ps-4 fw-bold text-secondary"><?php echo $row['ma_sv']; ?></td>
                                <td><span class="fw-bold text-dark"><?php echo $row['ho_ten']; ?></span></td>
                                <td><?php echo $row['gioi_tinh']; ?></td>
                                <td>
                                    <?php if($row['ten_phong']): ?>
                                        <span class="badge bg-info text-white px-3 py-2">Phòng <?php echo $row['ten_phong']; ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark px-3 py-2">Chưa xếp phòng</span>
                                    <?php endif; ?>
                                </td>
                                <td class="pe-4 text-end">
                                    <!-- ĐÃ CẬP NHẬT NÚT SỬA -->
                                    <a href="sua-sv.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-warning me-1">
                                        <i class="fa-solid fa-pen"></i> Sửa
                                    </a>
                                    <!-- ĐÃ CẬP NHẬT NÚT XÓA -->
                                    <a href="xoa-sv.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc muốn xóa sinh viên <?php echo $row['ho_ten']; ?>?');">
                                        <i class="fa-solid fa-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Chưa có sinh viên nào!</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>