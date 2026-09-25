<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM Gas WHERE GasID = $id";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['TenGas'] ?? 'Chi tiết Gas') ?></title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="../css/home.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

  <!-- TOPBAR -->
  <div id="topbar">
    <div class="topbar-left">
      <i class="bi bi-geo-alt-fill me-1"></i> Nha Trang
    </div>
    <div class="topbar-center d-none d-md-block">
      DỊCH VỤ GIAO GAS - GẠO - NƯỚC UỐNG TẬN NƠI
    </div>
    <div class="topbar-right">
      <a href="tel:02583891018" class="hotline-btn">HOTLINE: 0258 389 1018</a>
      <form class="search-form" role="search" action="search.php" method="GET">
        <input type="text" name="keyword" placeholder="Tìm kiếm...">
        <button type="submit"><i class="bi bi-search"></i></button>
      </form>
    </div>
  </div>

  <!-- NAVBAR -->
  <nav id="navbar" class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="../home.php">
        <img src="../img/logo.png" alt="GAS GIA HUY">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav fw-bold text-uppercase w-100 d-flex justify-content-evenly custom-nav">
          <li class="nav-item"><a class="nav-link" href="../home.php">Trang chủ</a></li>
          <li class="nav-item"><a class="nav-link" href="../html/gioithieu.html">Giới thiệu</a></li>
          <li class="nav-item"><a class="nav-link active" href="all_gas.php">Gas</a></li>
          <li class="nav-item"><a class="nav-link" href="all_gao.php">Gạo</a></li>
          <li class="nav-item"><a class="nav-link" href="all_nuocuong.php">Nước uống</a></li>
          <li class="nav-item"><a class="nav-link" href="../html/dichvu.html">Dịch vụ</a></li>
          <li class="nav-item"><a class="nav-link" href="../html/chinhsach.html">Chính sách</a></li>
        </ul>
      </div>
    </div>
  </nav>

<main>

<!-- BREADCRUMB -->
<div class="container mt-3">
  <nav aria-label="breadcrumb" style="background-color: #0d97d4; padding: 10px 15px; border-radius: 5px;">
    <ol class="breadcrumb mb-0 text-white">
      <li class="breadcrumb-item"><a href="../home.php" class="text-white text-decoration-none">Trang chủ</a></li>
      <li class="breadcrumb-item"><a href="all_gas.php" class="text-white text-decoration-none">Gas</a></li>
      <li class="breadcrumb-item active text-white" aria-current="page"><?= htmlspecialchars($product['TenGas'] ?? '') ?></li>
    </ol>
  </nav>
</div>

<!-- PRODUCT DETAIL -->
<div class="container my-5">
  <div class="row">
    <div class="col-md-6 text-center">
      <img src="../img/gas/<?= htmlspecialchars($product['HinhAnh'] ?? 'default.png') ?>" 
           alt="<?= htmlspecialchars($product['TenGas'] ?? '') ?>" 
           class="img-fluid mb-3" style="max-height: 500px;">
    </div>

    <div class="col-md-6">
      <h1 class="h3 mb-3"><?= htmlspecialchars($product['TenGas']) ?></h1>
      <p class="h4 text-danger mb-4"><strong><?= htmlspecialchars($product['GiaThanh']) ?></strong></p>

      <ul class="list-unstyled mb-4">
        <li class="mb-2"><strong>Thương hiệu:</strong> <?= htmlspecialchars($product['ThuongHieu']) ?></li>
        <li class="mb-2"><strong>Màu sắc:</strong> <?= htmlspecialchars($product['MauSac']) ?></li>
        <li class="mb-2"><strong>Trọng lượng vỏ bình:</strong> <?= htmlspecialchars($product['TrongLuongVoBinh']) ?> kg</li>
        <li class="mb-2"><strong>Thông tin:</strong> <?= nl2br(htmlspecialchars($product['ThongTin'])) ?></li>
        <li class="mb-2"><strong>Giao hàng tận nơi tại TP Nha Trang.</strong></li>
      </ul>

      <div class="alert alert-info border-primary" style="border: 2px dashed #0d6efd;">
        <i class="bi bi-truck text-primary me-2"></i>
        <strong>Giao miễn phí trong nội thành với đơn hàng từ 02 bình trở lên.</strong>
      </div>
    </div>
  </div>
</div>

<!-- SIDEBAR ADS -->
<div class="position-fixed" style="right: 20px; top: 50%; transform: translateY(-50%); z-index: 1000; width: 180px;">
  <div class="card mb-3 shadow">
    <div class="card-body p-2 text-center" style="background: linear-gradient(45deg, #007bff, #28a745);">
      <div class="text-white fw-bold">Khi sử dụng tất cả dịch vụ</div>
      <div class="text-warning fw-bold">Hotline: 0258 389 1018</div>
    </div>
  </div>

  <div class="card shadow">
    <div class="card-body p-2 text-center" style="background: linear-gradient(45deg, #ffc107, #17a2b8);">
      <small class="text-white fw-bold">CHUYÊN CUNG CẤP<br>Gas - Gạo - Nước Uống<br>TẠI TP Nha Trang</small>
      <div class="text-white fw-bold mt-1">Hotline: 0258 389 1018</div>
    </div>
  </div>
</div>

</main>

  <!-- FOOTER -->
  <footer class="text-light text-center text-white py-4" style="background-color: #0d97d4; width: 100%; margin-top: auto;">
      <div class="container" style="background-color: #0d97d4;">
          <p class="mb-1 fs-6">Copyright 2025 &copy; <strong>Đại Lý Gas Gia Huy</strong>. Chuyên cung cấp Gas - Gạo - Nước uống tận nơi.</p>
          <p class="mb-0">Địa chỉ: 18/1 Cầu Bè, Vĩnh Thạnh, Nha Trang, Khánh Hòa. Hotline: 0258 389 1018</p>
      </div>
  </footer>

<script src="../js/scroll.js"></script>

</body>
</html>
