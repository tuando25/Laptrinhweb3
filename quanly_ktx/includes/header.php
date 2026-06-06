<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Lý Kí Túc Xá</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; overflow-x: hidden; }
        .sidebar { width: 260px; height: 100vh; position: fixed; top: 0; left: 0; background-color: #1e293b; z-index: 1000; }
        .sidebar .nav-link { color: #94a3b8; padding: 12px 20px; font-weight: 500; display: flex; align-items: center; border-radius: 8px; margin: 4px 15px; text-decoration: none; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background-color: #334155; color: #fff; }
        .sidebar .nav-link i { width: 25px; font-size: 1.1rem; }
        .main-content { margin-left: 260px; min-height: 100vh; padding: 20px; box-sizing: border-box; }
        .top-navbar { background-color: #fff; border-bottom: 1px solid #e2e8f0; padding: 15px 30px; margin: -20px -20px 25px -20px; }
    </style>
</head>
<body>

    <!-- SIDEBAR BÊN TRÁI -->
    <div class="sidebar py-3">
        <div class="text-center text-white py-3 mb-4 border-bottom border-secondary mx-3">
            <h5 class="fw-bold mb-0 text-uppercase"><i class="fa-solid fa-hotel text-warning me-2"></i>Quản Lý KTX</h5>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="index.php"><i class="fa-solid fa-chart-pie"></i> Bảng điều khiển</a></li>
            <li class="nav-item"><a class="nav-link" href="danh-sach-phong.php"><i class="fa-solid fa-door-open"></i> Quản lý phòng</a></li>
            <li class="nav-item"><a class="nav-link" href="danh-sach-sv.php"><i class="fa-solid fa-users"></i> Quản lý sinh viên</a></li>
            <li class="nav-item"><a class="nav-link" href="danh-sach-hoa-don.php"><i class="fa-solid fa-file-invoice-dollar"></i> Hóa đơn</a></li>
        </ul>
    </div>

    <!-- KHU VỰC NỘI DUNG CHÍNH -->
    <div class="main-content">
        
        <!-- TOP NAVBAR -->
        <div class="top-navbar d-flex justify-content-between align-items-center shadow-sm">
            <div class="text-secondary fw-semibold"><i class="fa-solid fa-bars-staggered me-2"></i> Hệ thống ổn định</div>
            <div class="d-flex align-items-center">
                <div class="me-4 border-end pe-4 text-end d-none d-sm-block">
                    <span class="text-dark fw-bold"><i class="fa-solid fa-user-shield text-primary me-1"></i><?php echo $_SESSION['user_ten']; ?></span>
                </div>
                <a href="logout.php" class="btn btn-outline-danger btn-sm px-3 rounded-pill" onclick="return confirm('Xác nhận đăng xuất?');"><i class="fa-solid fa-power-off me-1"></i> Đăng xuất</a>
            </div>
        </div>