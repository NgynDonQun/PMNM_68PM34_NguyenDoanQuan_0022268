<?php
function lophoc_list_url($offsetVal, $limit, $search)
{
  $params = ['limit' => $limit, 'offset' => $offsetVal];
  if ($search !== '') $params['search'] = $search;
  return '/lophoc/index?' . http_build_query($params);
}
$currentPage = (int)floor($offset / max($limit, 1)) + 1;
$from = $totalRecords > 0 ? $offset + 1 : 0;
$to = min($offset + count($lophocs), $totalRecords);
$hasFilters = ($search !== '');
?>

<style>
  .page-head { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 16px; margin-bottom: 20px; }
  .page-title-row { display: flex; align-items: center; gap: 10px; }
  .page-title-row h1 { font-size: 24px; font-weight: 800; letter-spacing: -.01em; }
  .badge-count-strong { background: var(--color-primary-soft); color: var(--color-primary); font-size: 13px; font-weight: 800; padding: 4px 11px; }
  .page-subtitle { color: var(--color-text-muted); font-size: 14px; margin-top: 4px; }

  .toolbar { display: flex; flex-wrap: wrap; gap: 12px; padding: 16px 20px; border-bottom: 1px solid var(--color-border); align-items: center; }
  .toolbar form { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; flex: 1; }
  .search-field { position: relative; flex: 1; min-width: 220px; }
  .search-field svg { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: var(--color-text-muted); }
  .search-field input { padding-left: 36px; }
  .select-field { min-width: 140px; }
  .clear-link { font-size: 13px; font-weight: 600; color: var(--color-text-muted); }
  .clear-link:hover { color: var(--color-danger); }

  .siso-cell { min-width: 130px; }
  .siso-text { font-size: 12px; color: var(--color-text-muted); margin-bottom: 5px; }
  .siso-bar { width: 100%; height: 6px; border-radius: var(--radius-pill); background: var(--color-surface-alt); overflow: hidden; }
  .siso-bar-fill { height: 100%; background: var(--color-primary); border-radius: var(--radius-pill); }
  .actions-cell { display: flex; gap: 8px; }
</style>

<div class="page-head">
  <div>
    <div class="page-title-row">
      <h1><?php echo htmlspecialchars($title); ?></h1>
      <span class="badge badge-count-strong"><?php echo $totalRecords; ?></span>
    </div>
    <p class="page-subtitle">Quản lý danh sách lớp học và giáo viên chủ nhiệm</p>
  </div>
  <a href="/lophoc/create" class="btn btn-primary">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    Thêm lớp học
  </a>
</div>

<div class="card">
  <div class="toolbar">
    <form method="get" action="/lophoc/index">
      <input type="hidden" name="offset" value="0">
      <div class="search-field">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input class="input" type="text" name="search" placeholder="Tìm theo Mã lớp hoặc Tên lớp..." value="<?php echo htmlspecialchars($search); ?>">
      </div>
      <div class="select-field">
        <select class="select" name="limit">
          <?php foreach ([5, 10, 20, 50] as $opt): ?>
            <option value="<?php echo $opt; ?>" <?php echo ($limit == $opt) ? 'selected' : ''; ?>><?php echo $opt; ?> / trang</option>
          <?php endforeach; ?>
        </select>
      </div>
      <button type="submit" class="btn btn-outline">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        Tìm kiếm
      </button>
      <?php if ($hasFilters): ?>
        <a href="/lophoc/index" class="clear-link">Xóa bộ lọc</a>
      <?php endif; ?>
    </form>
  </div>

  <div class="table-wrap">
    <table class="data-table">
      <thead>
        <tr>
          <th>STT</th>
          <th>Mã lớp</th>
          <th>Tên lớp</th>
          <th>Sĩ số</th>
          <th>Giáo viên chủ nhiệm</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($lophocs)): ?>
          <tr>
            <td colspan="6">
              <div class="empty-state">Không tìm thấy lớp học nào phù hợp.</div>
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($lophocs as $index => $lophoc) : ?>
            <?php
              $siSoToiDa = max((int)$lophoc['SiSo'], 1);
              $siSoThucTe = (int)$lophoc['SiSoThucTe'];
              $percent = min(100, round(($siSoThucTe / $siSoToiDa) * 100));
            ?>
            <tr>
              <td><?php echo $offset + $index + 1; ?></td>
              <td><span class="mono"><?php echo htmlspecialchars($lophoc['MaLop']); ?></span></td>
              <td><strong><?php echo htmlspecialchars($lophoc['TenLop']); ?></strong></td>
              <td class="siso-cell">
                <div class="siso-text"><?php echo $siSoThucTe; ?> / <?php echo (int)$lophoc['SiSo']; ?> sinh viên</div>
                <div class="siso-bar"><div class="siso-bar-fill" style="width: <?php echo $percent; ?>%;"></div></div>
              </td>
              <td><?php echo htmlspecialchars($lophoc['GiaoVien']); ?></td>
              <td>
                <div class="actions-cell">
                  <a href="/lophoc/edit/<?php echo $lophoc['id']; ?>" class="btn btn-sm btn-pill-edit">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4Z"/></svg>
                    Sửa
                  </a>
                  <a href="/lophoc/delete/<?php echo $lophoc['id']; ?>" class="btn btn-sm btn-pill-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa lớp học này không?')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                    Xóa
                  </a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="list-footer">
    <div>Hiển thị <?php echo $from; ?>–<?php echo $to; ?> trong <?php echo $totalRecords; ?> bản ghi</div>
    <?php if ($totalPages > 1): ?>
      <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <?php $pageOffset = ($i - 1) * $limit; ?>
          <a class="page-link <?php echo ($i === $currentPage) ? 'active' : ''; ?>" href="<?php echo lophoc_list_url($pageOffset, $limit, $search); ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
