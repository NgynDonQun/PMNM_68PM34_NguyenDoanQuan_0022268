<?php
require_once "../app/core/controller.php";
class home extends Controller
{
    function index() {
        $sinhvienModel = $this->model('sinhvienModel');
        $svResult = $sinhvienModel->paging(1, 0);
        $totalSinhVien = $svResult['totalRecords'];

        $lophocModel = $this->model('lophocModel');
        $lhResult = $lophocModel->paging(1, 0);
        $totalLopHoc = $lhResult['totalRecords'];

        $this->view('layout/masterLayout', [
            'viewname' => 'home/index',
            'title' => 'Trang chủ',
            'totalSinhVien' => $totalSinhVien,
            'totalLopHoc' => $totalLopHoc,
        ]);
    }

    public function login() {
        // Trang đăng nhập độc lập, chưa có phiên đăng nhập nên không dùng masterLayout
        require_once '../app/views/home/login.php';
    }
}
?>
