<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>

  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2
    }

    th {
      background-color: #04AA6D;
      color: white;
    }
  </style>

</head>

<body>
  <h1><?php echo $title; ?></h1>
  <table>
    <tr>
      <th>STT</th>
      <th>MSSV</th>
      <th>Họ Tên</th>
      <th>Giới Tính</th>
      <th>Thao tác</th>
    </tr>
    <?php foreach ($sinhviens as $index => $sinhvien) : ?>
      <tr>
        <td><?php echo $index + 1; ?></td>
        <td><?php echo $sinhvien['MSSV']; ?></td>
        <td><?php echo $sinhvien['HoTen']; ?></td>
        <td><?php echo $sinhvien['GioiTinh']; ?></td>
        <td>
          <a href="/sinhvien/edit/<?php echo $sinhvien['id']; ?>" class="btn btn-primary">Sửa</a>
          <a href="/sinhvien/delete/<?php echo $sinhvien['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này không?')">Xóa</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <div>
    <?php
    $pageSize = 5;
    for ($i = 1; $i <= $totalPages; $i++) {
      $offset = ($i - 1) * $pageSize;
      echo "<a href='/sinhvien/index/$pageSize/$offset' class='btn btn-success' style='margin-right: 5px; margin-top: 5px;'>$i</a>";
    }
    ?>
  </div>

</body>

</html>