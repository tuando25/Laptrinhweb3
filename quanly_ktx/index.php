<?php 
// Gọi file kết nối CSDL và giao diện dùng chung vào
include 'config/db.php';     
include 'includes/header.php'; 

// Thực hiện câu lệnh SQL để đếm số lượng phòng và sinh viên
$tong_phong = $conn->query("SELECT COUNT(*) as total FROM phong")->fetch_assoc()['total'];
// (Tạm thời bảng sinh_vien chưa có dữ liệu nhiều hoặc chưa tạo, hệ thống vẫn trả về số 0 hoặc số lượng thực tế)
$tong_sv = $conn->query("SELECT COUNT(*) as total FROM sinh_vien")->fetch_assoc()['total'];
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fa-solid fa-gauge me-2 text-primary"></i>Trang Chủ Tổng Quan</h2>
    </div>

    <!-- Khu vực hiển thị các hộp thống kê (Thừa hưởng từ Bootstrap) -->
    <div class="row">
        <!-- Hộp 1: Tổng số phòng -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-white-50 text-uppercase mb-2">Tổng Số Phòng KTX</h6>
                        <h2 class="display-5 fw-bold mb-0"><?php echo $tong_phong; ?></h2>
                    </div>
                    <i class="fa-solid fa-door-open fa-3x text-white-50"></i>
                </div>
            </div>
        </div>

        <!-- Hộp 2: Tổng số sinh viên -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm bg-success text-white">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-white-50 text-uppercase mb-2">Sinh Viên Đang Ở</h6>
                        <h2 class="display-5 fw-bold mb-0"><?php echo $tong_sv; ?></h2>
                    </div>
                    <i class="fa-solid fa-users fa-3x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Lời chào ban quản lý -->
    <div class="card border-0 shadow-sm p-4 mt-2">
        <h4>Chào mừng bạn đến với Hệ thống Quản lý Kí túc xá</h4>
        <p class="text-muted mb-0">Sử dụng thanh menu bên trái để quản lý danh sách phòng, sinh viên và các hóa đơn dịch vụ.</p>
    </div>
</div>

<?php 
// Gọi chân trang để đóng các thẻ lại
include 'includes/footer.php'; 
?>