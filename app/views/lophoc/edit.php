<style>
  .form-head { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
  .back-link { display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: var(--color-text-muted); }
  .back-link:hover { color: var(--color-primary); }
  .form-card { padding: 28px; max-width: 560px; }
  .form-grid { display: grid; gap: 18px; }
  .form-actions { display: flex; gap: 10px; margin-top: 24px; }
</style>

<div class="form-head">
  <a href="/lophoc/index" class="back-link">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Quay lại danh sách
  </a>
</div>

<h1 style="font-size:22px; font-weight:800; margin-bottom:18px;">Sửa thông tin lớp học</h1>

<div class="card form-card">
  <form action="/lophoc/update/<?php echo $lophoc['id']; ?>" method="post" class="form-grid">
    <div>
      <label class="field-label" for="MaLop">Mã lớp</label>
      <input class="input" type="text" id="MaLop" name="MaLop" value="<?php echo htmlspecialchars($lophoc['MaLop']); ?>" required>
    </div>

    <div>
      <label class="field-label" for="TenLop">Tên lớp</label>
      <input class="input" type="text" id="TenLop" name="TenLop" value="<?php echo htmlspecialchars($lophoc['TenLop']); ?>" required>
    </div>

    <div>
      <label class="field-label" for="SiSo">Sĩ số tối đa</label>
      <input class="input" type="number" id="SiSo" name="SiSo" value="<?php echo htmlspecialchars($lophoc['SiSo']); ?>" min="0" required>
    </div>

    <div>
      <label class="field-label" for="GiaoVien">Giáo viên chủ nhiệm</label>
      <input class="input" type="text" id="GiaoVien" name="GiaoVien" value="<?php echo htmlspecialchars($lophoc['GiaoVien']); ?>" required>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Cập nhật</button>
      <a href="/lophoc/index" class="btn btn-outline">Hủy bỏ</a>
    </div>
  </form>
</div>
