<?php
// public/index.php — Front Controller

session_start();

// Đường dẫn gốc đến thư mục app
define('APP_PATH', dirname(__DIR__) . '/app/');

// Lấy route từ query string (được rewrite bởi .htaccess)
$route = $_GET['route'] ?? '';
$route = trim($route, '/');

// Routing đơn giản
switch ($route) {
    case '':
    case 'login':
        require APP_PATH . 'login.php';
        break;

    case 'auth':
        require APP_PATH . 'auth.php';
        break;

    case 'home':
        require APP_PATH . 'home.php';
        break;

    case 'logout':
        require APP_PATH . 'logout.php';
        break;

    default:
        http_response_code(404);
        echo '<h1>404 - Trang không tồn tại</h1>';
        break;
}
