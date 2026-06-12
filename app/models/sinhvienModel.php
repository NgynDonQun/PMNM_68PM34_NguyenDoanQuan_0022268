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

  public function getSinhVienById($id)
  {
    $query = "SELECT * FROM sinhvien WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update($id, $MSSV, $HoTen, $GioiTinh)
  {
    $query = "UPDATE sinhvien SET MSSV = :MSSV, HoTen = :HoTen, GioiTinh = :GioiTinh WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':MSSV', $MSSV);
    $stmt->bindParam(':HoTen', $HoTen);
    $stmt->bindParam(':GioiTinh', $GioiTinh);
    return $stmt->execute();
  }

  public function delete($id)
  {
    $query = "DELETE FROM sinhvien WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
}
