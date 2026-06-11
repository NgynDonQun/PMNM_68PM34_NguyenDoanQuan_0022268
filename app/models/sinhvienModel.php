<?php
require_once "../app/core/DB.php";
class sinhvienModel
{
  private $conn;
  public function __construct()
  {
    $this->conn = ConnectDB::Connect();
  }

  public function getAllSinhVien()
  {
    $query = "SELECT * FROM sinhvien";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function create($MSSV, $HoTen, $GioiTinh)
  {
    $query = "INSERT INTO sinhvien (MSSV, HoTen, GioiTinh) VALUES ( :MSSV, :HoTen, :GioiTinh )";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':MSSV', $MSSV);
    $stmt->bindParam(':HoTen', $HoTen);
    $stmt->bindParam(':GioiTinh', $GioiTinh);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function paging($limit = 5, $offset = 0, $search = "")
  {
    $query = "SELECT * FROM sinhvien LIMIT :limit OFFSET :offset";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Tính tổng số bảng ghi
    $selectAllQuery = $this->conn->query("SELECT COUNT(*) FROM sinhvien");
    $totalRecords = $selectAllQuery->fetchColumn();

    $totalPages = ceil($totalRecords / $limit);

    return ['sinhviens' => $result, 'totalPages' => $totalPages];
  }
}
