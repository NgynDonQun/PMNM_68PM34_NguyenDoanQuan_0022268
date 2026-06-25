<?php
require_once "../app/core/controller.php";
class sinhvien extends Controller
{
public function index()
  {
    // 1. Lấy dữ liệu từ URL (phục vụ bộ lọc và phân trang của View)
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
    $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
    $search = isset($_GET['search']) ? trim($_GET['search']) : "";
    $maLopFilter = isset($_GET['malop']) ? trim($_GET['malop']) : "";

    $sinhvienModel = $this->model('sinhvienModel');
    $result = $sinhvienModel->paging($limit, $offset, $search); 
    
    $sinhviens = $result['sinhviens'];
    $totalPages = $result['totalPages'];
    
    // 2. Bổ sung các biến View đang gọi mà bị thiếu
    $totalRecords = isset($result['totalRecords']) ? $result['totalRecords'] : count($sinhviens); 
    $lophocs = []; // Tạm thời để mảng rỗng cho View khỏi báo lỗi, bạn cần bổ sung logic lấy danh sách lớp sau

    // 3. Truyền đủ các tham số sang View
    $this->view('layout/masterLayout', [
      'viewname' => 'sinhvien/index', 
      'title' => 'Danh sách sinh viên', 
      'sinhviens' => $sinhviens, 
      'lophocs' => $lophocs,       // Thêm biến lophocs
      'limit' => $limit,           // Thêm biến limit
      'offset' => $offset,         // Thêm biến offset
      'search' => $search,         // Thêm biến search
      'maLopFilter' => $maLopFilter, // Thêm biến maLopFilter
      'totalPages' => $totalPages,
      'totalRecords' => $totalRecords // Thêm biến totalRecords
    ]);
  }

 public function create()
  {
    // 1. Gọi model lophocModel để lấy danh sách lớp
    $lophocModel = $this->model('lophocModel');
    $lophocs = $lophocModel->getAllLopHoc();

    // 2. Trả về View qua masterLayout để nhận CSS theme xanh, đồng thời truyền $lophocs sang
    $this->view('layout/masterLayout', [
      'viewname' => 'sinhvien/create',
      'title' => 'Thêm sinh viên',
      'lophocs' => $lophocs
    ]);
  }

  public function store()
  {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $MSSV = $_POST['MSSV'];
      $HoTen = $_POST['HoTen'];
      $GioiTinh = $_POST['GioiTinh'];
      
      // Bổ sung lấy thêm MaLop từ form gửi lên
      $MaLop = isset($_POST['MaLop']) ? $_POST['MaLop'] : null;
      
      $sinhvienModel = $this->model('sinhvienModel');
      
      // Chú ý: Bạn cần đảm bảo hàm create() trong sinhvienModel của bạn 
      // đã được cập nhật để nhận tham số thứ 4 là $MaLop nhé!
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

    // Lấy danh sách lớp để hiển thị trong <select>
    $lophocModel = $this->model('lophocModel');
    $lophocs = $lophocModel->getAllLopHoc();

    $this->view('layout/masterLayout', [
        'viewname' => 'sinhvien/edit', 
        'sinhvien' => $sinhvien, 
        'lophocs' => $lophocs, // Truyền biến lớp học sang view
        'title' => 'Sửa thông tin Sinh viên'
    ]);
  }

  public function update($id)
  {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = (int)$id;
      $MSSV = $_POST['MSSV'];
      $HoTen = $_POST['HoTen'];
      $GioiTinh = $_POST['GioiTinh'];
      
      // Hứng thêm biến MaLop từ form Edit
      $MaLop = isset($_POST['MaLop']) ? $_POST['MaLop'] : null; 

      $sinhvienModel = $this->model('sinhvienModel');
      
      // Chú ý: Đảm bảo hàm update() trong Model của bạn đã nhận thêm tham số $MaLop
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

