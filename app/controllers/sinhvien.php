<?php
require_once "../app/core/controller.php";
class sinhvien extends Controller
{
  public function index($limitParam = null, $offsetParam = null)
  {
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : ($limitParam !== null ? (int)$limitParam : 10);
    $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : ($offsetParam !== null ? (int)$offsetParam : 0);
    $limit = $limit > 0 ? $limit : 10;
    $offset = $offset >= 0 ? $offset : 0;
    $search = trim($_GET['search'] ?? '');
    $maLopFilter = trim($_GET['malop'] ?? '');

    $sinhvienModel = $this->model('sinhvienModel');
    $result = $sinhvienModel->paging($limit, $offset, $search, $maLopFilter);
    $sinhviens = $result['sinhviens'];
    $totalPages = $result['totalPages'];
    $totalRecords = $result['totalRecords'];

    $lophocModel = $this->model('lophocModel');
    $lophocs = $lophocModel->getAllLopHoc();

    // Trả về View
    $this->view('layout/masterLayout', [
      'viewname' => 'sinhvien/index',
      'sinhviens' => $sinhviens,
      'title' => 'Danh sách sinh viên',
      'totalPages' => $totalPages,
      'totalRecords' => $totalRecords,
      'limit' => $limit,
      'offset' => $offset,
      'search' => $search,
      'maLopFilter' => $maLopFilter,
      'lophocs' => $lophocs,
    ]);
  }

  public function create()
  {
    $lophocModel = $this->model('lophocModel');
    $lophocs = $lophocModel->getAllLopHoc();

    // Trả về View
    $this->view('layout/masterLayout', [
      'viewname' => 'sinhvien/create',
      'title' => 'Thêm sinh viên',
      'lophocs' => $lophocs,
    ]);
  }

  public function store()
  {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $MSSV = $_POST['MSSV'];
      $HoTen = $_POST['HoTen'];
      $GioiTinh = $_POST['GioiTinh'];
      $MaLop = $_POST['MaLop'] !== '' ? $_POST['MaLop'] : null;

      $sinhvienModel = $this->model('sinhvienModel');
      $result = $sinhvienModel->create($MSSV, $HoTen, $GioiTinh, $MaLop);
      if ($result) {
        header("Location: /sinhvien/index");
        exit();
      } else {
        echo "Thêm mới sinh viên thất bại!";
        exit();
      }
    }
  }

  public function edit($id)
  {
    $id = (int)$id;
    $sinhvienModel = $this->model('sinhvienModel');
    $sinhvien = $sinhvienModel->getSinhVienById($id);

    if (!$sinhvien) {
      echo "Sinh viên không tồn tại!";
      exit();
    }

    $lophocModel = $this->model('lophocModel');
    $lophocs = $lophocModel->getAllLopHoc();

    $this->view('layout/masterLayout', [
      'viewname' => 'sinhvien/edit',
      'sinhvien' => $sinhvien,
      'lophocs' => $lophocs,
      'title' => 'Sửa thông tin Sinh viên',
    ]);
  }

  public function update($id)
  {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = (int)$id;
      $MSSV = $_POST['MSSV'];
      $HoTen = $_POST['HoTen'];
      $GioiTinh = $_POST['GioiTinh'];
      $MaLop = $_POST['MaLop'] !== '' ? $_POST['MaLop'] : null;

      $sinhvienModel = $this->model('sinhvienModel');
      $result = $sinhvienModel->update($id, $MSSV, $HoTen, $GioiTinh, $MaLop);

      if ($result) {
        header("Location: /sinhvien/index");
        exit();
      } else {
        echo "Cập nhật sinh viên thất bại!";
        exit();
      }
    }
  }

  public function delete($id)
  {
    $id = (int)$id;
    $sinhvienModel = $this->model('sinhvienModel');
    $result = $sinhvienModel->delete($id);

    if ($result) {
      header("Location: /sinhvien/index");
      exit();
    } else {
      echo "Xoá sinh vien thất bại!";
      exit();
    }
  }
}
