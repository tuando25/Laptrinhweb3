<?php 
// 1. Gọi file kết nối cơ sở dữ liệu và giao diện thanh menu (Sidebar)
include 'config/db.php';     
include 'includes/header.php'; 

// 2. Truy vấn lấy danh sách hóa đơn kết hợp với tên phòng từ bảng phong
$sql = "SELECT hoa_don.*, phong.ten_phong 
        FROM hoa_don 
        JOIN phong ON hoa_don.id_phong = phong.id
        ORDER BY hoa_don.thang_nam DESC, phong.ten_phong ASC";
$result = $conn->query($sql);
?>

<div class="container-fluid">
    <!-- Tiêu đề trang -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="fa-solid fa-file-invoice-dollar text-primary me-2"></i>Quản Lý Hóa Đơn Điện Nước</h3>
        <a href="them-hoa-don.php" class="btn btn-primary shadow-sm">
    <i class="fa-solid fa-plus me-1"></i> Lập Hóa Đơn Mới
</a>
    </div>

    <!-- Bảng danh sách hóa đơn -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width: 1000px;">
                    <thead class="table-light text-uppercase fs-7 fw-semibold text-secondary">
                        <tr>
                            <th class="ps-4">Tên Phòng</th>
                            <th>Tháng / Năm</th>
                            <th>Tiền Phòng</th>
                            <th>Tiền Điện</th>
                            <th>Tiền Nước</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng Thái</th>
                            <th class="pe-4 text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <!-- Tên phòng -->
                                <td class="ps-4">
                                    <span class="fw-bold text-dark fs-6">Phòng <?php echo htmlspecialchars($row['ten_phong']); ?></span>
                                </td>
                                
                                <!-- Tháng năm -->
                                <td class="text-secondary font-monospace">
                                    <i class="fa-regular fa-calendar me-1"></i><?php echo htmlspecialchars($row['thang_nam']); ?>
                                </td>
                                
                                <!-- Chi tiết các khoản tiền -->
                                <td><?php echo number_format($row['tien_phong']); ?> đ</td>
                                <td><?php echo number_format($row['tien_dien']); ?> đ</td>
                                <td><?php echo number_format($row['tien_nuoc']); ?> đ</td>
                                
                                <!-- Tổng tiền làm nổi bật -->
                                <td class="fw-bold text-primary fs-6">
                                    <?php echo number_format($row['tong_tien']); ?> VNĐ
                                </td>
                                
                                <!-- Badge hiển thị trạng thái hóa đơn -->
                                <td>
                                    <?php if($row['trang_thai'] == 'Đã thanh toán'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-circle-check me-1"></i>Đã thanh toán
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-circle-exclamation me-1"></i>Chưa thanh toán
                                        </span>
                                    <?php endif; ?>
                                </td>
                                
                                <!-- Cột hành động xử lý thu tiền tự động -->
                                <td class="pe-4 text-end">
                                    <?php if ($row['trang_thai'] == 'Chưa thanh toán'): ?>
                                        <!-- Nếu chưa thanh toán: Hiện nút bấm để thu tiền -->
                                        <a href="xu-ly-thu-tien.php?id=<?php echo $row['id']; ?>" 
                                           class="btn btn-sm btn-success px-3 shadow-sm"
                                           onclick="return confirm('Xác nhận đã thu đủ tiền của Phòng <?php echo htmlspecialchars($row['ten_phong']); ?>?');">
                                            <i class="fa-solid fa-cash-register me-1"></i> Thu tiền
                                        </a>
                                    <?php else: ?>
                                        <!-- Nếu đã thanh toán: Ẩn nút, hiện thông báo hoàn thành -->
                                        <span class="text-success fw-bold font-monospace fs-7 bg-light px-2 py-1 border rounded">
                                            <i class="fa-solid fa-check-double"></i> Đã xong
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <!-- Hiển thị khi database chưa có hóa đơn nào -->
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-file-invoice fa-2x mb-2 d-block text-secondary"></i>
                                    Chưa có hóa đơn nào được lập trong hệ thống!
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
// 3. Gọi file chân trang giao diện (Footer)
include 'includes/footer.php'; 
?>