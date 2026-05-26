<?php
// app/login.php — Trang đăng nhập

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Nếu đã đăng nhập rồi thì chuyển thẳng vào home
if (!empty($_SESSION['logged_in'])) {
    header('Location: index.php?route=home');
    exit;
}

// Lấy thông báo lỗi (nếu có) rồi xóa khỏi session
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0d0f14;
            --surface:   #161a22;
            --border:    #252b38;
            --accent:    #4f8ef7;
            --accent-glow: rgba(79,142,247,.25);
            --text:      #e8ecf4;
            --muted:     #6b7694;
            --error-bg:  rgba(239,68,68,.12);
            --error-border: rgba(239,68,68,.4);
            --error-text: #f87171;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg);
            font-family: 'Be Vietnam Pro', sans-serif;
            color: var(--text);
            background-image:
                radial-gradient(ellipse 80% 50% at 20% 10%, rgba(79,142,247,.08) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 90%, rgba(79,142,247,.05) 0%, transparent 60%);
        }

        .card {
            width: 100%;
            max-width: 420px;
            margin: 1.5rem;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2.5rem 2.25rem;
            box-shadow: 0 24px 60px rgba(0,0,0,.5);
            animation: slideUp .45s cubic-bezier(.22,.68,0,1.2) both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .logo {
            width: 48px; height: 48px;
            background: linear-gradient(135deg, var(--accent), #7eb8ff);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.4rem;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: .4rem;
        }

        .subtitle {
            font-size: .875rem;
            color: var(--muted);
            margin-bottom: 2rem;
        }

        /* Error box */
        .alert-error {
            display: flex;
            align-items: center;
            gap: .6rem;
            background: var(--error-bg);
            border: 1px solid var(--error-border);
            color: var(--error-text);
            border-radius: 10px;
            padding: .75rem 1rem;
            font-size: .875rem;
            margin-bottom: 1.5rem;
            animation: shake .4s ease;
        }

        @keyframes shake {
            0%,100% { transform: translateX(0); }
            20%      { transform: translateX(-6px); }
            40%      { transform: translateX(6px); }
            60%      { transform: translateX(-4px); }
            80%      { transform: translateX(4px); }
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            font-size: .8rem;
            font-weight: 600;
            color: var(--muted);
            letter-spacing: .05em;
            text-transform: uppercase;
            margin-bottom: .5rem;
        }

        input {
            width: 100%;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: .75rem 1rem;
            color: var(--text);
            font-size: .95rem;
            font-family: inherit;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }

        input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        input::placeholder { color: var(--muted); }

        button[type="submit"] {
            width: 100%;
            margin-top: .5rem;
            padding: .85rem;
            background: var(--accent);
            color: #fff;
            font-family: inherit;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 4px 20px var(--accent-glow);
        }

        button[type="submit"]:hover {
            background: #6ba3ff;
            transform: translateY(-1px);
            box-shadow: 0 8px 28px rgba(79,142,247,.4);
        }

        button[type="submit"]:active { transform: translateY(0); }

        .hint {
            margin-top: 1.5rem;
            font-size: .8rem;
            color: var(--muted);
            text-align: center;
            border-top: 1px solid var(--border);
            padding-top: 1rem;
        }
    </style>
</head>
<body>
<div class="card">
    <div class="logo">🔐</div>
    <h1>Đăng nhập</h1>
    <p class="subtitle">Vui lòng nhập thông tin tài khoản để tiếp tục</p>

    <?php if ($error): ?>
        <div class="alert-error">
            <span>⚠️</span>
            <span><?= htmlspecialchars($error) ?></span>
        </div>
    <?php endif; ?>

    <form action="index.php?route=auth" method="POST">
        <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <input
                type="text"
                id="username"
                name="username"
                placeholder="Nhập tên đăng nhập"
                autocomplete="username"
                required
            >
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Nhập mật khẩu"
                autocomplete="current-password"
                required
            >
        </div>

        <button type="submit">Đăng nhập →</button>
    </form>

    <p class="hint">Tài khoản demo: <strong>admin</strong> / <strong>123456</strong></p>
</div>
</body>
</html>
