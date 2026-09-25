<?php
include __DIR__ . '/connect.php';
include_once __DIR__ . '/function.php';

$keyword = '';
$results = [];

if (isset($_GET['keyword']) && trim($_GET['keyword']) !== '') {
    $keyword = trim($_GET['keyword']);
    $escapedKeyword = $conn->real_escape_string($keyword);

    $sql = "SELECT 'gas' AS type, GasID AS id, TenGas AS name, GiaThanh, HinhAnh 
            FROM Gas 
            WHERE TenGas LIKE '%$escapedKeyword%' OR ThuongHieu LIKE '%$escapedKeyword%' 
            UNION ALL 
            SELECT 'gao', GaoID, TenGao, GiaThanh, HinhAnh 
            FROM Gao 
            WHERE TenGao LIKE '%$escapedKeyword%' OR ThuongHieu LIKE '%$escapedKeyword%' 
            UNION ALL 
            SELECT 'nuocuong', NuocUongID, TenNuocUong, GiaThanh, HinhAnh 
            FROM NuocUong 
            WHERE TenNuocUong LIKE '%$escapedKeyword%' OR ThuongHieu LIKE '%$escapedKeyword%'";

    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Kết quả tìm kiếm cho "<?= htmlspecialchars($keyword) ?>"</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="/final_report/css/home.css">
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
      <form class="search-form" action="search.php" method="get" role="search">
        <input type="text" name="keyword" placeholder="Tìm kiếm..." value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit"><i class="bi bi-search"></i></button>
      </form>
    </div>
  </div>

  <!-- NAVBAR -->
  <nav id="navbar" class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="/final_report/home.php">
        <img src="/final_report/img/logo.png" alt="GAS GIA HUY">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav fw-bold text-uppercase w-100 d-flex justify-content-evenly custom-nav">
          <li class="nav-item"><a class="nav-link" href="../home.php">Trang chủ</a></li>
          <li class="nav-item"><a class="nav-link" href="../html/gioithieu.html">Giới thiệu</a></li>
          <li class="nav-item"><a class="nav-link" href="all_gas.php">Gas</a></li>
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
      <li class="breadcrumb-item"><a href="all_gas.php" class="text-white text-decoration-none">Tìm kiếm "<?= htmlspecialchars($keyword) ?>"</a></li>
    </ol>
  </nav>
</div>

<!-- KẾT QUẢ TÌM KIẾM -->
<div class="container py-5">
  <?php if ($keyword): ?>
    <h2 class='my-4'>Kết quả tìm kiếm cho: <em><?= htmlspecialchars($keyword) ?></em></h2>
    <?php if ($result && $result->num_rows > 0): ?>
      <div class='row row-cols-1 row-cols-md-3 g-4'>
        <?php while ($row = $result->fetch_assoc()): ?>
          <?php
            $link = "/final_report/php/detail_{$row['type']}.php?id={$row['id']}";
            $imgDir = "/final_report/img/{$row['type']}/" . htmlspecialchars($row['HinhAnh']);
          ?>
          <div class='col'>
            <a href='<?= $link ?>' class='text-decoration-none text-dark'>
              <div class='card product-card h-100'>
                <img src='<?= $imgDir ?>' class='card-img-top' alt='<?= htmlspecialchars($row['name']) ?>'>
                <div class='card-body text-center'>
                  <h5 class='card-title'><?= htmlspecialchars($row['name']) ?></h5>
                  <p class='text-danger fw-bold'>
                    <?= (is_numeric($row['GiaThanh']) && $row['GiaThanh'] > 0)
                        ? number_format($row['GiaThanh'], 0, ',', '.') . "₫"
                        : "Liên hệ" ?>
                  </p>
                </div>
              </div>
            </a>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p>Không tìm thấy kết quả phù hợp.</p>
    <?php endif; ?>
  <?php else: ?>
    <p>Vui lòng nhập từ khóa tìm kiếm.</p>
  <?php endif; ?>
</div>

</main>

  <!-- FOOTER -->
  <footer class="text-light text-center text-white py-4" style="background-color: #0d97d4; width: 100%; margin-top: auto;">
      <div class="container" style="background-color: #0d97d4;">
          <p class="mb-1 fs-6">Copyright 2025 &copy; <strong>Đại Lý Gas Gia Huy</strong>. Chuyên cung cấp Gas - Gạo - Nước uống tận nơi.</p>
          <p class="mb-0">Địa chỉ: 18/1 Cầu Bè, Vĩnh Thạnh, Nha Trang, Khánh Hòa. Hotline: 0258 389 1018</p>
      </div>
  </footer>

  <script src="/final_report/js/scroll.js"></script>

</body>
</html>
