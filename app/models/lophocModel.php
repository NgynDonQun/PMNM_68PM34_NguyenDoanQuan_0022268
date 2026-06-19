<?php
require_once "../app/core/DB.php";
class lophocModel
{
  private $conn;
  public function __construct()
  {
    $this->conn = ConnectDB::Connect();
  }

  public function getAllLopHoc()
  {
    $query = "SELECT * FROM lophoc ORDER BY id ASC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function create($MaLop, $TenLop, $SiSo, $GiaoVien)
  {
    $query = "INSERT INTO lophoc (MaLop, TenLop, SiSo, GiaoVien) VALUES (:MaLop, :TenLop, :SiSo, :GiaoVien)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':MaLop', $MaLop);
    $stmt->bindParam(':TenLop', $TenLop);
    $stmt->bindParam(':SiSo', $SiSo, PDO::PARAM_INT);
    $stmt->bindParam(':GiaoVien', $GiaoVien);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function paging($limit = 10, $offset = 0, $search = "")
  {
    $conditions = [];
    $params = [];

    if ($search !== "") {
      $conditions[] = "(lh.MaLop LIKE :search OR lh.TenLop LIKE :search)";
      $params[':search'] = '%' . $search . '%';
    }
    $whereSql = $conditions ? ('WHERE ' . implode(' AND ', $conditions)) : '';

    // Đếm số sinh viên thực tế đang thuộc mỗi lớp
    $query = "SELECT lh.*, COUNT(sv.id) AS SiSoThucTe
              FROM lophoc lh
              LEFT JOIN sinhvien sv ON sv.MaLop = lh.MaLop
              $whereSql
              GROUP BY lh.id
              ORDER BY lh.id ASC
              LIMIT :limit OFFSET :offset";
    $stmt = $this->conn->prepare($query);
    foreach ($params as $key => $value) {
      $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $countQuery = "SELECT COUNT(*) FROM lophoc lh $whereSql";
    $countStmt = $this->conn->prepare($countQuery);
    foreach ($params as $key => $value) {
      $countStmt->bindValue($key, $value);
    }
    $countStmt->execute();
    $totalRecords = (int)$countStmt->fetchColumn();

    $totalPages = $limit > 0 ? (int)ceil($totalRecords / $limit) : 1;

    return [
      'lophocs' => $result,
      'totalPages' => $totalPages,
      'totalRecords' => $totalRecords,
    ];
  }

  public function getLopHocById($id)
  {
    $query = "SELECT * FROM lophoc WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update($id, $MaLop, $TenLop, $SiSo, $GiaoVien)
  {
    $query = "UPDATE lophoc SET MaLop = :MaLop, TenLop = :TenLop, SiSo = :SiSo, GiaoVien = :GiaoVien WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':MaLop', $MaLop);
    $stmt->bindParam(':TenLop', $TenLop);
    $stmt->bindParam(':SiSo', $SiSo, PDO::PARAM_INT);
    $stmt->bindParam(':GiaoVien', $GiaoVien);
    return $stmt->execute();
  }

  public function delete($id)
  {
    $query = "DELETE FROM lophoc WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
}
