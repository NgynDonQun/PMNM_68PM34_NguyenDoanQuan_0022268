<?php
    require_once '../app/core/DB.php';
    class sinhvienModel {
        private $conn;
        public function __construct() {
            $this -> conn = ConnectDB::Connect();
        }

        public function getAllSinhvien() {
            $query = "SELECT * FROM sinhvien";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function create($hoten, $gioitinh, $mssv){
            $query = "INSERT INTO sinhvien (hoten, gioitinh, mssv) VALUES (:hoten, :gioitinh, :mssv)";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> bindParam(':hoten', $hoten);
            $stmt -> bindParam(':gioitinh', $gioitinh);
            $stmt -> bindParam(':mssv', $mssv);
            if($stmt -> execute()) {
                return true;
            } else {
                return false;
            }
        }
    }
?>