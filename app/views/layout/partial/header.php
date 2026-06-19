<?php
$__currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
$__currentPath = rtrim($__currentPath, '/');
$__navItems = [
    ['href' => '/home/index', 'label' => 'Trang chủ', 'match' => '/home'],
    ['href' => '/sinhvien/index', 'label' => 'Sinh viên', 'match' => '/sinhvien'],
    ['href' => '/lophoc/index', 'label' => 'Lớp học', 'match' => '/lophoc'],
];
?>
<style>
  .topbar {
    background: var(--color-primary);
    background-image: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
  }
  .topbar-inner {
    max-width: 1180px;
    margin: 0 auto;
    padding: 14px 24px;
    display: flex;
    align-items: center;
    gap: 28px;
    color: #fff;
  }
  .brand { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 16px; letter-spacing: -.01em; }
  .brand-mark {
    width: 32px; height: 32px; border-radius: 9px;
    background: rgba(255,255,255,.16);
    display: flex; align-items: center; justify-content: center;
  }
  .brand-mark svg { width: 18px; height: 18px; }
  .topnav { display: flex; gap: 4px; flex: 1; }
  .topnav a {
    padding: 8px 14px;
    border-radius: var(--radius-pill);
    font-size: 14px;
    font-weight: 600;
    color: rgba(255,255,255,.78);
  }
  .topnav a:hover { color: #fff; background: rgba(255,255,255,.10); }
  .topnav a.active { color: var(--color-primary-dark); background: #fff; }
  .user-chip { display: flex; align-items: center; gap: 10px; font-size: 14px; }
  .user-chip .avatar-sm {
    width: 30px; height: 30px; border-radius: 50%;
    background: rgba(255,255,255,.18);
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 13px;
  }
  .logout-link {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 13px; font-weight: 600;
    color: rgba(255,255,255,.78);
    padding: 6px 10px; border-radius: var(--radius-sm);
  }
  .logout-link:hover { color: #fff; background: rgba(255,255,255,.10); }
  @media (max-width: 720px) {
    .topbar-inner { flex-wrap: wrap; gap: 12px; padding: 14px 16px; }
    .topnav { width: 100%; order: 3; }
  }
</style>
<header class="topbar">
  <div class="topbar-inner">
    <div class="brand">
      <span class="brand-mark">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10 12 5 2 10l10 5 10-5Z"/><path d="M6 12v5c0 1.5 2.7 3 6 3s6-1.5 6-3v-5"/></svg>
      </span>
      <span>QLSinhVien</span>
    </div>
    <nav class="topnav">
      <?php foreach ($__navItems as $item): ?>
        <?php $isActive = $__currentPath !== '' && strpos($__currentPath, $item['match']) === 0; ?>
        <a href="<?php echo $item['href']; ?>" class="<?php echo $isActive ? 'active' : ''; ?>"><?php echo $item['label']; ?></a>
      <?php endforeach; ?>
    </nav>
    <?php if (isset($_SESSION['username'])): ?>
      <div class="user-chip">
        <span class="avatar-sm"><?php echo mb_strtoupper(mb_substr($_SESSION['username'], 0, 1, 'UTF-8'), 'UTF-8'); ?></span>
        <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
        <a href="/auth/logout" class="logout-link">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          Đăng xuất
        </a>
      </div>
    <?php endif; ?>
  </div>
</header>
