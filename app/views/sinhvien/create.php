<style>
  .form-head { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
  .back-link { display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: var(--color-text-muted); }
  .back-link:hover { color: var(--color-primary); }
  .form-card { padding: 28px; max-width: 560px; }
  .form-grid { display: grid; gap: 18px; }
  .form-actions { display: flex; gap: 10px; margin-top: 24px; }
</style>

<div class="form-head">
  <a href="/sinhvien/index" class="back-link">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Quay lại danh sách
  </a>
</div>

<h1 style="font-size:22px; font-weight:800; margin-bottom:18px;">Thêm sinh viên</h1>

<div class="card form-card">
  <form action="/sinhvien/store" method="post" class="form-grid">
    <div>
      <label class="field-label" for="MSSV">MSSV</label>
      <input class="input" type="text" id="MSSV" name="MSSV" placeholder="VD: SV2401010" required>
    </div>

    <div>
      <label class="field-label" for="HoTen">Họ tên</label>
      <input class="input" type="text" id="HoTen" name="HoTen" placeholder="VD: Nguyễn Văn A" required>
    </div>

    <div>
      <label class="field-label" for="GioiTinh">Giới tính</label>
      <select class="select" id="GioiTinh" name="GioiTinh" required>
        <option value="">-- Chọn giới tính --</option>
        <option value="Nam">Nam</option>
        <option value="Nữ">Nữ</option>
      </select>
    </div>

    <div>
      <label class="field-label" for="MaLop">Lớp học</label>
      <select class="select" id="MaLop" name="MaLop">
        <option value="">-- Chưa chọn lớp --</option>
        <?php foreach ($lophocs as $lop) : ?>
          <option value="<?php echo htmlspecialchars($lop['MaLop']); ?>">
            <?php echo htmlspecialchars($lop['MaLop'] . ' - ' . $lop['TenLop']); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Tạo sinh viên</button>
      <a href="/sinhvien/index" class="btn btn-outline">Hủy bỏ</a>
    </div>
  </form>
</div>
