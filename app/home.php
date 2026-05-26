<?php
// app/home.php — Trang chủ (yêu cầu đăng nhập)

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Bảo vệ trang: chưa đăng nhập → về login
if (empty($_SESSION['logged_in'])) {
    header('Location: index.php?route=login');
    exit;
}

$username = htmlspecialchars($_SESSION['username'] ?? 'Người dùng');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:      #0d0f14;
            --surface: #161a22;
            --border:  #252b38;
            --accent:  #4f8ef7;
            --accent-glow: rgba(79,142,247,.2);
            --text:    #e8ecf4;
            --muted:   #6b7694;
        }

        body {
            min-height: 100vh;
            background: var(--bg);
            font-family: 'Be Vietnam Pro', sans-serif;
            color: var(--text);
            background-image:
                radial-gradient(ellipse 80% 50% at 20% 10%, rgba(79,142,247,.08) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 90%, rgba(79,142,247,.05) 0%, transparent 60%);
        }

        /* ── Navbar ── */
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2rem;
            border-bottom: 1px solid var(--border);
            background: rgba(22,26,34,.8);
            backdrop-filter: blur(12px);
            position: sticky; top: 0; z-index: 10;
        }

        .nav-brand {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--accent);
            letter-spacing: .02em;
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: .875rem;
            color: var(--muted);
        }

        .avatar {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, var(--accent), #7eb8ff);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
            font-size: .9rem;
            color: #fff;
            flex-shrink: 0;
        }

        .btn-logout {
            padding: .45rem 1rem;
            background: transparent;
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--muted);
            font-family: inherit;
            font-size: .85rem;
            cursor: pointer;
            text-decoration: none;
            transition: border-color .2s, color .2s;
        }

        .btn-logout:hover {
            border-color: #ef4444;
            color: #f87171;
        }

        /* ── Main ── */
        main {
            max-width: 760px;
            margin: 0 auto;
            padding: 4rem 1.5rem;
            animation: fadeIn .5s ease both;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .tag {
            display: inline-block;
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--accent);
            background: var(--accent-glow);
            padding: .3rem .8rem;
            border-radius: 99px;
            margin-bottom: 1.25rem;
        }

        h1 {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 700;
            line-height: 1.15;
            margin-bottom: 1rem;
        }

        .welcome {
            font-size: 1.15rem;
            color: var(--muted);
            line-height: 1.7;
        }

        .welcome strong {
            color: var(--text);
            font-weight: 600;
        }

        /* ── Card grid ── */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 3rem;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.5rem;
            transition: border-color .2s, transform .2s;
        }

        .card:hover {
            border-color: var(--accent);
            transform: translateY(-3px);
        }

        .card-icon { font-size: 1.6rem; margin-bottom: .75rem; }
        .card-title { font-weight: 600; margin-bottom: .3rem; }
        .card-desc  { font-size: .85rem; color: var(--muted); line-height: 1.5; }
    </style>
</head>
<body>

<nav>
    <span class="nav-brand">🏠 MyApp</span>
    <div class="nav-user">
        <div class="avatar"><?= strtoupper(substr($username, 0, 1)) ?></div>
        <span><?= $username ?></span>
        <a href="index.php?route=logout" class="btn-logout">Đăng xuất</a>
    </div>
</nav>

<main>
    <span class="tag">Trang Chủ</span>
    <h1>Xin chào, <br><?= $username ?> 👋</h1>
    <p class="welcome">Chào mừng <strong><?= $username ?></strong> đã quay trở lại. Bạn đã đăng nhập thành công vào hệ thống.</p>

    <div class="cards">
        <div class="card">
            <div class="card-icon">📊</div>
            <div class="card-title">Tổng quan</div>
            <div class="card-desc">Xem thống kê và báo cáo hoạt động của hệ thống.</div>
        </div>
        <div class="card">
            <div class="card-icon">👥</div>
            <div class="card-title">Sinh viên</div>
            <div class="card-desc">Quản lý danh sách và thông tin sinh viên.</div>
        </div>
        <div class="card">
            <div class="card-icon">⚙️</div>
            <div class="card-title">Cài đặt</div>
            <div class="card-desc">Tuỳ chỉnh thông tin tài khoản và cấu hình hệ thống.</div>
        </div>
    </div>
</main>

</body>
</html>
