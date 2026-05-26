<?php
// app/logout.php — Đăng xuất

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Xóa toàn bộ dữ liệu session
$_SESSION = [];

// Xóa cookie session nếu có
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Hủy session
session_destroy();

// Chuyển về trang login
header('Location: index.php?route=login');
exit;
