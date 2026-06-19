<?php
$activeModule = isset($viewname) ? explode('/', $viewname)[0] : '';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($title ?? 'QLSinhVien'); ?> · QLSinhVien</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --color-bg: #F4F6FB;
      --color-surface: #FFFFFF;
      --color-surface-alt: #F8F9FD;
      --color-primary: #3454D1;
      --color-primary-dark: #28409E;
      --color-primary-soft: #EAEEFC;
      --color-success: #15803D;
      --color-success-soft: #E8F8EE;
      --color-warning: #B45309;
      --color-warning-soft: #FEF3E2;
      --color-danger: #B91C1C;
      --color-danger-soft: #FCE9E9;
      --color-rose: #BE185D;
      --color-rose-soft: #FCE7F3;
      --color-text: #1E2433;
      --color-text-muted: #69708A;
      --color-border: #E4E7F1;
      --radius-sm: 8px;
      --radius-md: 14px;
      --radius-lg: 20px;
      --radius-pill: 999px;
      --shadow-card: 0 1px 2px rgba(20,24,38,.04), 0 10px 24px -14px rgba(20,24,38,.18);
      --font-display: 'Be Vietnam Pro', system-ui, sans-serif;
      --font-mono: 'JetBrains Mono', monospace;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: var(--font-display);
      background: var(--color-bg);
      color: var(--color-text);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    a { color: inherit; text-decoration: none; }

    .shell {
      width: 100%;
      max-width: 1180px;
      margin: 0 auto;
      padding: 28px 24px 64px;
      flex: 1;
    }

    /* ---------- Card primitives ---------- */
    .card {
      background: var(--color-surface);
      border: 1px solid var(--color-border);
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-card);
    }

    /* ---------- Buttons ---------- */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-family: var(--font-display);
      font-weight: 600;
      font-size: 14px;
      padding: 10px 18px;
      border-radius: var(--radius-md);
      border: 1px solid transparent;
      cursor: pointer;
      transition: transform .05s ease, filter .15s ease, background .15s ease;
      white-space: nowrap;
    }
    .btn:active { transform: translateY(1px); }
    .btn svg { width: 16px; height: 16px; flex-shrink: 0; }

    .btn-primary { background: var(--color-primary); color: #fff; }
    .btn-primary:hover { background: var(--color-primary-dark); }

    .btn-success { background: var(--color-success); color: #fff; }
    .btn-success:hover { filter: brightness(0.92); }

    .btn-outline {
      background: var(--color-surface);
      color: var(--color-text);
      border-color: var(--color-border);
    }
    .btn-outline:hover { background: var(--color-surface-alt); }

    .btn-sm { padding: 7px 12px; font-size: 13px; border-radius: var(--radius-sm); }

    .btn-pill-edit {
      background: var(--color-warning-soft);
      color: var(--color-warning);
    }
    .btn-pill-edit:hover { filter: brightness(0.96); }

    .btn-pill-delete {
      background: var(--color-danger-soft);
      color: var(--color-danger);
    }
    .btn-pill-delete:hover { filter: brightness(0.96); }

    /* ---------- Badges / pills ---------- */
    .badge {
      display: inline-flex;
      align-items: center;
      font-size: 12px;
      font-weight: 700;
      padding: 3px 10px;
      border-radius: var(--radius-pill);
    }
    .badge-count { background: rgba(255,255,255,.18); color: #fff; }
    .badge-primary { background: var(--color-primary-soft); color: var(--color-primary); }
    .badge-rose { background: var(--color-rose-soft); color: var(--color-rose); }
    .badge-muted { background: var(--color-surface-alt); color: var(--color-text-muted); border: 1px solid var(--color-border); }

    /* ---------- Form controls ---------- */
    .field-label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: var(--color-text-muted);
      margin-bottom: 6px;
    }
    .input, .select {
      width: 100%;
      font-family: var(--font-display);
      font-size: 14px;
      color: var(--color-text);
      background: var(--color-surface);
      border: 1px solid var(--color-border);
      border-radius: var(--radius-md);
      padding: 10px 14px;
      outline: none;
      transition: border-color .15s ease, box-shadow .15s ease;
    }
    .input:focus, .select:focus {
      border-color: var(--color-primary);
      box-shadow: 0 0 0 3px var(--color-primary-soft);
    }

    /* ---------- Table ---------- */
    .table-wrap { overflow-x: auto; }
    table.data-table { width: 100%; border-collapse: collapse; }
    .data-table th {
      text-align: left;
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: .04em;
      color: var(--color-text-muted);
      background: var(--color-surface-alt);
      padding: 12px 16px;
      border-bottom: 1px solid var(--color-border);
      white-space: nowrap;
    }
    .data-table td {
      padding: 12px 16px;
      border-bottom: 1px solid var(--color-border);
      font-size: 14px;
      vertical-align: middle;
    }
    .data-table tr:last-child td { border-bottom: none; }
    .data-table tbody tr:hover { background: var(--color-surface-alt); }

    .avatar {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 13px;
      flex-shrink: 0;
    }
    .name-cell { display: flex; align-items: center; gap: 10px; font-weight: 600; }
    .mono { font-family: var(--font-mono); font-size: 13px; color: var(--color-text-muted); }

    .empty-state {
      text-align: center;
      padding: 48px 16px;
      color: var(--color-text-muted);
    }

    /* ---------- Pagination footer ---------- */
    .list-footer {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      padding: 16px 20px;
      border-top: 1px solid var(--color-border);
      font-size: 13px;
      color: var(--color-text-muted);
    }
    .pagination { display: flex; gap: 6px; flex-wrap: wrap; }
    .page-link {
      min-width: 32px;
      height: 32px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: var(--radius-sm);
      font-size: 13px;
      font-weight: 600;
      color: var(--color-text-muted);
      border: 1px solid var(--color-border);
      background: var(--color-surface);
    }
    .page-link:hover { background: var(--color-surface-alt); }
    .page-link.active { background: var(--color-primary); color: #fff; border-color: var(--color-primary); }

    @media (max-width: 720px) {
      .shell { padding: 20px 14px 48px; }
    }
  </style>
</head>

<body>
  <?php require_once '../app/views/layout/partial/header.php'; ?>
  <main class="shell">
    <?php require_once '../app/views/' . $viewname . '.php'; ?>
  </main>
  <?php require_once '../app/views/layout/partial/footer.php'; ?>
</body>

</html>
