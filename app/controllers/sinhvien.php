<?php
require_once "../app/core/controller.php";
class sinhvien extends Controller
{
  public function index($limit = 5, $offset = 0, $search = "")
  {
    $sinhvienModel = $this->model('sinhvienModel');
    //$sinhviens = $sinhvienModel->getAllSinhVien();
    $result = $sinhvienModel->paging($limit, $offset, $search);
    $sinhviens = $result['sinhviens'];
    $totalPages = $result['totalPages'];
    // Trả về View
    //require_once "../app/views/sinhvien/index.php";
    $this->view('layout/masterLayout', ['viewname' => 'sinhvien/index', 'sinhviens' => $sinhviens, 'title' => 'Danh sách sinh viên', 'totalPages' => $totalPages]);
  }

  public function create()
  {
    // Trả về View
    require_once "../app/views/sinhvien/create.php";
  }

  public function store()
  {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $MSSV = $_POST['MSSV'];
      $HoTen = $_POST['HoTen'];
      $GioiTinh = $_POST['GioiTinh'];

      $sinhvienModel = $this->model('sinhvienModel');
      $result = $sinhvienModel->create($MSSV, $HoTen, $GioiTinh);
      if ($result) {
        header("Location: /sinhvien/index");
        exit();
      } else {
        echo "Thêm mới sinh viên thất bại!";
        exit();
      }
    }
  }
}
