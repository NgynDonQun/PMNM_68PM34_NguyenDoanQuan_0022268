<?php
// app/auth.php — Xử lý xác thực đăng nhập

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Danh sách tài khoản được phép đăng nhập
// Trong thực tế nên hash mật khẩu bằng password_hash()
$accounts = [
    ['username' => 'admin',    'password' => '123456'],
    ['username' => 'nguyen',   'password' => 'abc123'],
    ['username' => 'tran',     'password' => 'pass456'],
];

// Chỉ xử lý khi có POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?route=login');
    exit;
}

$inputUser = trim($_POST['username'] ?? '');
$inputPass = trim($_POST['password'] ?? '');

$authenticated = false;

foreach ($accounts as $account) {
    if ($account['username'] === $inputUser && $account['password'] === $inputPass) {
        $authenticated = true;
        break;
    }
}

if ($authenticated) {
    // Lưu thông tin đăng nhập vào session
    $_SESSION['logged_in'] = true;
    $_SESSION['username']  = $inputUser;

    // Chuyển đến trang chủ
    header('Location: index.php?route=home');
    exit;
} else {
    // Lưu thông báo lỗi vào session để hiển thị ở login
    $_SESSION['login_error'] = 'Sai tên đăng nhập hoặc mật khẩu!';

    header('Location: index.php?route=login');
    exit;
}
