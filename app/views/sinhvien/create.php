<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>
</head>
<body>
    <h1> Thêm sinh viên </h1>
    <form action="/sinhvien/store" method="POST">
        <label for="MSSV">Mã sinh viên</label>
        <input type="text" name="mssv" id="MSSV">
        <br>
        <label for="HoTen">Họ tên</label>
        <input type="text" name="hoten" id="HoTen">
        <br>
        <label for="GioiTinh">Giới tính</label>
        <input type="text" name="gioitinh" id="GioiTinh">
        <br>
        <input type="submit" value="Thêm">
    </form>
    <h2> Đây là trang tạo sinh viên</h2>
</body>
</html>