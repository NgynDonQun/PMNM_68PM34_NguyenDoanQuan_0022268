<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập · QLSinhVien</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-bg: #F4F6FB;
            --color-surface: #FFFFFF;
            --color-primary: #3454D1;
            --color-primary-dark: #28409E;
            --color-primary-soft: #EAEEFC;
            --color-text: #1E2433;
            --color-text-muted: #69708A;
            --color-border: #E4E7F1;
            --radius-md: 14px;
            --radius-lg: 20px;
            --shadow-card: 0 1px 2px rgba(20,24,38,.04), 0 10px 24px -14px rgba(20,24,38,.18);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Be Vietnam Pro', system-ui, sans-serif;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            width: 100%;
            max-width: 380px;
            background: var(--color-surface);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            padding: 36px 32px;
        }
        .brand-mark {
            width: 48px; height: 48px; border-radius: 13px;
            background: var(--color-primary-soft);
            color: var(--color-primary);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 18px;
        }
        .brand-mark svg { width: 26px; height: 26px; }
        h1 { font-size: 22px; font-weight: 800; color: var(--color-text); margin-bottom: 4px; }
        .subtitle { font-size: 14px; color: var(--color-text-muted); margin-bottom: 26px; }
        .field-label { display: block; font-size: 13px; font-weight: 600; color: var(--color-text-muted); margin-bottom: 6px; }
        .input {
            width: 100%;
            font-family: inherit;
            font-size: 14px;
            color: var(--color-text);
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            padding: 11px 14px;
            outline: none;
            transition: border-color .15s ease, box-shadow .15s ease;
        }
        .input:focus { border-color: var(--color-primary); box-shadow: 0 0 0 3px var(--color-primary-soft); }
        .field { margin-bottom: 16px; }
        .submit-btn {
            width: 100%;
            margin-top: 8px;
            padding: 12px;
            border: none;
            border-radius: var(--radius-md);
            background: var(--color-primary);
            color: #fff;
            font-family: inherit;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: background .15s ease;
        }
        .submit-btn:hover { background: var(--color-primary-dark); }
    </style>
</head>
<body>
    <div class="login-card">
        <span class="brand-mark">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10 12 5 2 10l10 5 10-5Z"/><path d="M6 12v5c0 1.5 2.7 3 6 3s6-1.5 6-3v-5"/></svg>
        </span>
        <h1>Đăng nhập</h1>
        <p class="subtitle">Hệ thống Quản lý Sinh viên</p>
        <form action="/auth/login" method="post">
            <div class="field">
                <label class="field-label" for="username">Tên đăng nhập</label>
                <input class="input" type="text" id="username" name="username" required autofocus>
            </div>
            <div class="field">
                <label class="field-label" for="password">Mật khẩu</label>
                <input class="input" type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="submit-btn">Đăng nhập</button>
        </form>
    </div>
</body>
</html>
