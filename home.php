<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang chủ - Đại Lý Gạo Nước Gas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="css/home.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
  </style>

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
      <form class="search-form" role="search" action="php/search.php" method="GET">
        <input type="text" name="keyword" placeholder="Tìm kiếm...">
        <button type="submit"><i class="bi bi-search"></i></button>
      </form>
    </div>
  </div>

  <!-- NAVBAR -->
  <nav id="navbar" class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="home.php">
        <img src="img/logo.png" alt="GAS GIA HUY">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav fw-bold text-uppercase w-100 d-flex justify-content-evenly custom-nav">
          <li class="nav-item"><a class="nav-link active" href="home.php">Trang chủ</a></li>
          <li class="nav-item"><a class="nav-link" href="html/gioithieu.html">Giới thiệu</a></li>
          <li class="nav-item"><a class="nav-link" href="php/all_gas.php">Gas</a></li>
          <li class="nav-item"><a class="nav-link" href="php/all_gao.php">Gạo</a></li>
          <li class="nav-item"><a class="nav-link" href="php/all_nuocuong.php">Nước uống</a></li>
          <li class="nav-item"><a class="nav-link" href="html/dichvu.html">Dịch vụ</a></li>
          <li class="nav-item"><a class="nav-link" href="html/chinhsach.html">Chính sách</a></li>
        </ul>
      </div>
    </div>
  </nav>

<main>
  
<!-- BANNER -->
<div class="container py-3" style="background-color: #f8f9fa;">
  <div id="bannerCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner rounded shadow">
      <div class="carousel-item active">
        <img src="img/banner.jpg" class="d-block w-100" alt="Gas Gia Huy Banner">
      </div>
      <div class="carousel-item">
        <img src="img/banner1.jpg" class="d-block w-100" alt="Gas Gia Huy Banner">
      </div>
      <div class="carousel-item">
        <img src="img/banner2.jpg" class="d-block w-100" alt="Gas Gia Huy Banner">
      </div>
    </div>
  </div>
</div>

<!-- DATABASE QUERY -->
<?php
include 'php/connect.php';
include_once 'php/function.php';

// GasGas
$sql = "SELECT GasID, TenGas, GiaThanh, HinhAnh FROM gas";
$result = $conn->query($sql);

$gasProducts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $gasProducts[] = $row;
    }
}
$chunksGas = chunkArray($gasProducts, 4);

// Gao
$sql = "SELECT GaoID, TenGao, GiaThanh, HinhAnh FROM gao";
$result = $conn->query($sql);

$gaoProducts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $gaoProducts[] = $row;
    }
}
$chunksGao = chunkArray($gaoProducts, 4);

// NuocUong
$sql = "SELECT NuocUongID, TenNuocUong, GiaThanh, HinhAnh FROM NuocUong";
$result = $conn->query($sql);

$nuocUongProducts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nuocUongProducts[] = $row;
    }
}
$chunksNuocUong = chunkArray($nuocUongProducts, 4);
?>

<!-- GAS -->
<section class="container my-5" id="gas">
  <div class="section-title">
    <h3 class="mx-3 fw-bold mb-0">GAS</h3>
  </div>

  <?php if (count($gasProducts) > 4): ?>
    <div id="gasCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php foreach ($chunksGas as $index => $group): ?>
          <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <div class="row g-4 justify-content-center">
              <?php foreach ($group as $product): ?>
                <div class="col-md-3">
                  <a href="php/detail_gas.php?id=<?= $product['GasID'] ?>" class="text-decoration-none text-dark">
                    <div class="card product-card h-100">
                      <img src="img/gas/<?= htmlspecialchars($product['HinhAnh']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['TenGas']) ?>">
                      <div class="card-body text-center">
                        <h6 class="text-primary mb-1"><?= htmlspecialchars($product['TenGas']) ?></h6>
                        <p class="text-danger fw-bold mb-0">
                          <?= is_numeric($product['GiaThanh']) && $product['GiaThanh'] > 0
                            ? number_format($product['GiaThanh'], 0, ',', '.') . '₫'
                            : 'Liên hệ' ?>
                        </p>
                      </div>
                    </div>
                  </a>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#gasCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#gasCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

  <?php else: ?>
    <div class="row g-4 justify-content-center">
      <?php foreach ($gasProducts as $product): ?>
        <div class="col-md-3">
          <a href="php/detail_gas.php?id=<?= $product['GasID'] ?>" class="text-decoration-none text-dark">
            <div class="card product-card h-100">
              <img src="img/gas/<?= htmlspecialchars($product['HinhAnh']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['TenGas']) ?>">
              <div class="card-body text-center">
                <h6 class="text-primary mb-1"><?= htmlspecialchars($product['TenGas']) ?></h6>
                <p class="text-danger fw-bold mb-0">
                  <?= is_numeric($product['GiaThanh']) && $product['GiaThanh'] > 0
                    ? number_format($product['GiaThanh'], 0, ',', '.') . '₫'
                    : 'Liên hệ' ?>
                </p>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>

<!-- GAO -->
<section class="container my-5" id="gao">
  <div class="section-title"><h3 class="mx-3 fw-bold mb-0">GẠO</h3></div>
  <?php if (count($gaoProducts) <= 4): ?>
    <div class="row g-4 justify-content-center">
      <?php foreach ($gaoProducts as $row): ?>
        <div class="col-md-3">
          <a href="php/detail_gao.php?id=<?= $row['GaoID'] ?>" class="text-decoration-none text-dark">
            <div class="card product-card h-100">
              <img src="img/gao/<?php echo htmlspecialchars($row['HinhAnh']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['TenGao']); ?>">
              <div class="card-body text-center">
                <h6 class="text-primary mb-1"><?php echo htmlspecialchars($row['TenGao']); ?></h6>
                <p class="text-danger fw-bold mb-0">
                  <?php
                    if (is_numeric($row['GiaThanh']) && $row['GiaThanh'] > 0) {
                      echo number_format($row['GiaThanh'], 0, ',', '.') . 'đ';
                    } else {
                      echo 'Liên hệ';
                    }
                  ?>
                </p>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div id="gaoCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php foreach ($chunksGao as $index => $chunk): ?>
          <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
            <div class="row g-4 justify-content-center">
              <?php foreach ($chunk as $row): ?>
                <div class="col-md-3">
                  <a href="php/detail_gao.php?id=<?= $row['GaoID'] ?>" class="text-decoration-none text-dark">
                    <div class="card product-card h-100">
                      <img src="img/gao/<?php echo htmlspecialchars($row['HinhAnh']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['TenGao']); ?>">
                      <div class="card-body text-center">
                        <h6 class="text-primary mb-1"><?php echo htmlspecialchars($row['TenGao']); ?></h6>
                        <p class="text-danger fw-bold mb-0">
                          <?php
                            if (is_numeric($row['GiaThanh']) && $row['GiaThanh'] > 0) {
                              echo number_format($row['GiaThanh'], 0, ',', '.') . 'đ';
                            } else {
                              echo 'Liên hệ';
                            }
                          ?>
                        </p>
                      </div>
                    </div>
                  </a>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#gaoCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#gaoCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  <?php endif; ?>
</section>

<!-- NUOC -->
<section class="container my-5" id="nuoc">
  <div class="section-title">
    <h3 class="mx-3 fw-bold mb-0">NƯỚC UỐNG</h3>
  </div>
  <?php if (count($nuocUongProducts) > 4): ?>
    <div id="nuocCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php foreach ($chunksNuocUong as $index => $chunk): ?>
          <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <div class="row g-4 justify-content-center">
              <?php foreach ($chunk as $product): ?>
                <div class="col-md-3">
                  <a href="php/detail_nuocuong.php?id=<?= $product['NuocUongID'] ?>" class="text-decoration-none text-dark">
                    <div class="card product-card h-100">
                      <img 
                        src="img/nuocuong/<?= htmlspecialchars($product['HinhAnh']) ?>" 
                        class="card-img-top" 
                        alt="<?= htmlspecialchars($product['TenNuocUong']) ?>">
                      <div class="card-body text-center">
                        <h6 class="text-primary mb-1"><?= htmlspecialchars($product['TenNuocUong']) ?></h6>
                        <p class="text-danger fw-bold mb-0">
                          <?= is_numeric($product['GiaThanh']) && $product['GiaThanh'] > 0 
                            ? number_format($product['GiaThanh'], 0, ',', '.') . '₫' 
                            : 'Liên hệ' ?>
                        </p>
                      </div>
                    </div>
                  </a>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#nuocCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#nuocCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  <?php else: ?>
    <div class="row g-4 justify-content-center">
      <?php foreach ($chunksNuocUong as $product): ?>
        <div class="col-md-3">
          <a href="php/detail_nuocuong.php?id=<?= $product['NuocUongID'] ?>" class="text-decoration-none text-dark">
            <div class="card product-card h-100">
              <img 
                src="img/nuocuong/<?= htmlspecialchars($product['HinhAnh']) ?>" 
                class="card-img-top" 
                alt="<?= htmlspecialchars($product['TenNuocUong']) ?>">
              <div class="card-body text-center">
                <h6 class="text-primary mb-1"><?= htmlspecialchars($product['TenNuocUong']) ?></h6>
                <p class="text-danger fw-bold mb-0">
                  <?= is_numeric($product['GiaThanh']) && $product['GiaThanh'] > 0 
                    ? number_format($product['GiaThanh'], 0, ',', '.') . '₫' 
                    : 'Liên hệ' ?>
                </p>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>

</main>

  <!-- FOOTER -->
  <footer class="text-light text-center text-white py-4" style="background-color: #0d97d4; width: 100%; margin-top: auto;">
      <div class="container" style="background-color: #0d97d4;">
          <p class="mb-1 fs-6">Copyright 2025 &copy; <strong>Đại Lý Gas Gia Huy</strong>. Chuyên cung cấp Gas - Gạo - Nước uống tận nơi.</p>
          <p class="mb-0">Địa chỉ: 18/1 Cầu Bè, Vĩnh Thạnh, Nha Trang, Khánh Hòa. Hotline: 0258 389 1018</p>
      </div>
  </footer>

  <script src="js/scroll.js"></script>

</body>
</html>
