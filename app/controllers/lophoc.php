<?php
require_once "../app/core/controller.php";
class lophoc extends Controller
{
  public function index($limitParam = null, $offsetParam = null)
  {
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : ($limitParam !== null ? (int)$limitParam : 10);
    $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : ($offsetParam !== null ? (int)$offsetParam : 0);
    $limit = $limit > 0 ? $limit : 10;
    $offset = $offset >= 0 ? $offset : 0;
    $search = trim($_GET['search'] ?? '');

    $lophocModel = $this->model('lophocModel');
    $result = $lophocModel->paging($limit, $offset, $search);
    $lophocs = $result['lophocs'];
    $totalPages = $result['totalPages'];
    $totalRecords = $result['totalRecords'];

    // Trả về View
    $this->view('layout/masterLayout', [
      'viewname' => 'lophoc/index',
      'lophocs' => $lophocs,
      'title' => 'Danh sách lớp học',
      'totalPages' => $totalPages,
      'totalRecords' => $totalRecords,
      'limit' => $limit,
      'offset' => $offset,
      'search' => $search,
    ]);
  }

  public function create()
  {
    // Trả về View
    $this->view('layout/masterLayout', [
      'viewname' => 'lophoc/create',
      'title' => 'Thêm lớp học',
    ]);
  }

  public function store()
  {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $MaLop = $_POST['MaLop'];
      $TenLop = $_POST['TenLop'];
      $SiSo = $_POST['SiSo'];
      $GiaoVien = $_POST['GiaoVien'];

      $lophocModel = $this->model('lophocModel');
      $result = $lophocModel->create($MaLop, $TenLop, $SiSo, $GiaoVien);
      if ($result) {
        header("Location: /lophoc/index");
        exit();
      } else {
        echo "Thêm mới lớp học thất bại!";
        exit();
      }
    }
  }

  public function edit($id)
  {
    $id = (int)$id;
    $lophocModel = $this->model('lophocModel');
    $lophoc = $lophocModel->getLopHocById($id);

    if (!$lophoc) {
      echo "Lớp học không tồn tại!";
      exit();
    }

    $this->view('layout/masterLayout', [
      'viewname' => 'lophoc/edit',
      'lophoc' => $lophoc,
      'title' => 'Sửa thông tin Lớp học',
    ]);
  }

  public function update($id)
  {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = (int)$id;
      $MaLop = $_POST['MaLop'];
      $TenLop = $_POST['TenLop'];
      $SiSo = $_POST['SiSo'];
      $GiaoVien = $_POST['GiaoVien'];

      $lophocModel = $this->model('lophocModel');
      $result = $lophocModel->update($id, $MaLop, $TenLop, $SiSo, $GiaoVien);

      if ($result) {
        header("Location: /lophoc/index");
        exit();
      } else {
        echo "Cập nhật lớp học thất bại!";
        exit();
      }
    }
  }

  public function delete($id)
  {
    $id = (int)$id;
    $lophocModel = $this->model('lophocModel');
    $result = $lophocModel->delete($id);

    if ($result) {
      header("Location: /lophoc/index");
      exit();
    } else {
      echo "Xoá lớp học thất bại!";
      exit();
    }
  }
}
