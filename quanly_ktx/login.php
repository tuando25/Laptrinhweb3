<?php
session_start();
include 'config/db.php';

// Nếu đã đăng nhập rồi thì tự chuyển vào trang chủ luôn, không cho ở lại trang login
if (isset($_SESSION['user_admin'])) {
    header("Location: index.php");
    exit();
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = md5($_POST['password']); // Mã hóa MD5 để khớp với DB

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Ghi lại Session để hệ thống nhận diện đã đăng nhập
        $_SESSION['user_admin'] = $user['username'];
        $_SESSION['user_ten'] = $user['ho_ten'];
        
        header("Location: index.php");
        exit();
    } else {
        $error = "Tài khoản hoặc mật khẩu không chính xác!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Hệ thống Quản lý KTX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fa-solid fa-hotel fa-3x text-primary mb-2"></i>
                        <h4 class="fw-bold text-dark">ĐĂNG NHẬP</h4>
                        <p class="text-muted fs-7">Vui lòng đăng nhập hệ thống quản lý</p>
                    </div>

                    <?php if($error != ""): ?>
                        <div class="alert alert-danger py-2 fs-7"><i class="fa-solid fa-triangle-exclamation me-1"></i> <?php echo $error; ?></div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Tên đăng nhập</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-user"></i></span>
                                <input type="text" name="username" class="form-control border-start-0 ps-0" placeholder="Nhập tên..." required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary">Mật khẩu</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" class="form-control border-start-0 ps-0" placeholder="Nhập mật khẩu..." required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">
                            <i class="fa-solid fa-right-to-bracket me-1"></i> Đăng Nhập
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>