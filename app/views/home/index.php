<style>
  .hero-card {
    padding: 32px;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    color: #fff;
    margin-bottom: 24px;
  }
  .hero-card h1 { font-size: 24px; font-weight: 800; margin-bottom: 6px; }
  .hero-card p { color: rgba(255,255,255,.82); font-size: 14px; }

  .quick-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; }
  .quick-card { padding: 22px; display: flex; flex-direction: column; gap: 10px; }
  .quick-icon {
    width: 40px; height: 40px; border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
  }
  .quick-icon svg { width: 20px; height: 20px; }
  .quick-card .stat { font-size: 28px; font-weight: 800; }
  .quick-card .label { font-size: 13px; color: var(--color-text-muted); font-weight: 600; }
  .quick-card .go-link { font-size: 13px; font-weight: 700; color: var(--color-primary); margin-top: auto; display: inline-flex; align-items: center; gap: 4px; }
</style>

<div class="card hero-card">
  <h1>Chào mừng quay lại, <?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?> 👋</h1>
  <p>Đây là tổng quan nhanh về hệ thống quản lý sinh viên của bạn.</p>
</div>

<div class="quick-grid">
  <a href="/sinhvien/index" class="card quick-card">
    <span class="quick-icon" style="background: var(--color-primary-soft); color: var(--color-primary);">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </span>
    <div class="stat"><?php echo (int)$totalSinhVien; ?></div>
    <div class="label">Sinh viên đang quản lý</div>
    <span class="go-link">Xem danh sách
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
    </span>
  </a>

  <a href="/lophoc/index" class="card quick-card">
    <span class="quick-icon" style="background: var(--color-success-soft); color: var(--color-success);">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10 12 5 2 10l10 5 10-5Z"/><path d="M6 12v5c0 1.5 2.7 3 6 3s6-1.5 6-3v-5"/></svg>
    </span>
    <div class="stat"><?php echo (int)$totalLopHoc; ?></div>
    <div class="label">Lớp học hiện có</div>
    <span class="go-link">Xem danh sách
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
    </span>
  </a>
</div>
