<?php 
// 1. Gọi file kết nối cơ sở dữ liệu và giao diện thanh menu (Sidebar)
include 'config/db.php';     
include 'includes/header.php'; 

// 2. Câu lệnh SQL lấy toàn bộ danh sách phòng, sắp xếp theo tên phòng từ A-Z
$result = $conn->query("SELECT * FROM phong ORDER BY ten_phong ASC");
?>

<div class="container-fluid py-3">
    <!-- Tiêu đề trang và Nút Thêm Phòng (Đã sửa thành thẻ <a> để thao tác được) -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">
            <i class="fa-solid fa-door-open text-primary me-2"></i>Quản Lý Phòng Kí Túc Xá
        </h3>
        <!-- ĐÃ CẬP NHẬT THÀNH THẺ A ĐỂ BẤM ĐƯỢC CHUYỂN TRANG -->
        <a href="them-phong.php" class="btn btn-primary shadow-sm fw-semibold">
            <i class="fa-solid fa-plus me-1"></i> Thêm Phòng Mới
        </a>
    </div>

    <!-- Bảng hiển thị danh sách phòng -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width: 900px;">
                    <thead class="table-light text-uppercase fs-7 fw-semibold text-secondary">
                        <tr>
                            <th class="ps-4">Tên Phòng</th>
                            <th>Loại Phòng</th>
                            <th>Sức Chứa</th>
                            <th>Hiện Ở</th>
                            <th>Trạng Thái</th>
                            <th>Giá Phòng / Tháng</th>
                            <th class="pe-4 text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <!-- Tên Phòng -->
                                <td class="ps-4">
                                    <span class="fw-bold text-dark fs-5"><?php echo htmlspecialchars($row['ten_phong']); ?></span>
                                </td>
                                
                                <!-- Loại Phòng -->
                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-2"><?php echo htmlspecialchars($row['loai_phong']); ?></span>
                                </td>
                                
                                <!-- Sức Chứa gốc -->
                                <td><?php echo intval($row['suc_chua']); ?> người</td>
                                
                                <!-- Số người đang ở -->
                                <td>
                                    <span class="text-primary fw-bold"><?php echo intval($row['so_nguoi_o']); ?></span> người
                                </td>
                                
                                <!-- Tự động tính toán trạng thái hiển thị màu sắc -->
                                <td>
                                    <?php if ($row['so_nguoi_o'] >= $row['suc_chua']): ?>
                                        <span class="badge bg-danger px-3 py-2"><i class="fa-solid fa-user-lock me-1"></i> Đã đủ người</span>
                                    <?php elseif ($row['so_nguoi_o'] == 0): ?>
                                        <span class="badge bg-secondary px-3 py-2"><i class="fa-solid fa-door-open me-1"></i> Phòng trống</span>
                                    <?php else: ?>
                                        <span class="badge bg-success px-3 py-2"><i class="fa-solid fa-user-check me-1"></i> Còn chỗ</span>
                                    <?php endif; ?>
                                </td>
                                
                                <!-- Giá phòng định dạng VNĐ -->
                                <td class="text-success fw-bold">
                                    <?php echo number_format($row['gia_phong']); ?> VNĐ
                                </td>
                                
                                <!-- Các nút thao tác Sửa / Xóa -->
                                <td class="pe-4 text-end">
                                    <a href="sua-phong.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-warning me-1">
                                        <i class="fa-solid fa-pen"></i> Sửa
                                    </a>
                                    <a href="xoa-phong.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa phòng <?php echo htmlspecialchars($row['ten_phong']); ?> không? Toàn bộ sinh viên thuộc phòng này sẽ bị ảnh hưởng!');">
                                        <i class="fa-solid fa-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <!-- Hiển thị khi database chưa có phòng nào -->
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i> Chưa có dữ liệu phòng nào trong hệ thống!
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php 
// 3. Gọi file chân trang giao diện để đóng kín các thẻ div
include 'includes/footer.php'; 
?>