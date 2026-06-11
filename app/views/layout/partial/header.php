<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <style>
    header nav {
      height: 60px;
    }
  </style>
</head>

<body>
  <!-- A grey horizontal navbar that becomes vertical on small screens -->
  <header>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <div class="container-fluid">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="/sinhvien/index">Quản lý sinh viên</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/home/index">Quản lý lớp học</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</body>

</html>