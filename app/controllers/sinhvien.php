<?php
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    function index() {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhvien = $sinhvienModel -> getAllSinhvien();
        //trả về view 
        //require_once '../app/views/sinhvien/index.php';
        $this -> view('layout/masterlayout', ['viewname'=> 'sinhvien/index', 'sinhvien' => $sinhvien, 'title' => 'Danh sách sinh viên']);
    }

    function create() {
        //trả về view 
        require_once '../app/views/sinhvien/create.php';
    }
    
    function store() {
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $hoten = $_POST['hoten'] ?? '';
            $gioitinh = $_POST['gioitinh'] ?? '';
            $mssv = $_POST['mssv'] ?? '';
            $sinhvienModel = $this -> model('sinhvienModel');
            $result = $sinhvienModel -> create($hoten, $gioitinh, $mssv);
            if($result) {
                echo "Thêm sinh viên thành công";
            } else {
                echo "Thêm sinh viên thất bại";
            }
        }
    }
}
