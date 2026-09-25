<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ Quản trị - Đại lý Gia Huy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>

    <?php
        require_once "php/connect.php";

        $gas = "SELECT * FROM Gas";
        $gao = "SELECT * FROM Gao";
        $nuocuong = "SELECT * FROM NuocUong";
        $result_gas = mysqli_query($conn, $gas);
        $result_gao = mysqli_query($conn, $gao);
        $result_nuocuong = mysqli_query($conn, $nuocuong);
    ?>

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
        </div>
    </div>

     <!-- NAVBAR -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light">
        <div class="container">
        <a class="navbar-brand" href="admin.php">
            <img src="img/logo.png" alt="GAS GIA HUY">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav fw-bold text-uppercase w-100 d-flex justify-content-evenly custom-nav">
            <li class="nav-item"><a class="nav-link active" href="admin.php">Quản trị</a></li>
            <li class="nav-item"><a class="nav-link" href="#gas">Gas</a></li>
            <li class="nav-item"><a class="nav-link" href="#gao">Gạo</a></li>
            <li class="nav-item"><a class="nav-link" href="#nuocuong">Nước uống</a></li>
            </ul>
        </div>
        </div>
    </nav>

    <!-- GAS -->
    <section class="container my-5" id="gas" style="padding-top: 100px;">
        <div class="d-flex align-items-center justify-content-center mb-4">
            <div style="flex: 1; height: 1px; background-color: lightgray;"></div>
            <h3 class="mx-3 fw-bold mb-0" style="font-weight: bold;">GAS</h3>
            <div style="flex: 1; height: 1px; background-color: lightgray;"></div>
        </div>
        <table class="custom-table">
            <tr class="control" style="text-align: left; font-weight: bold; font-size: 20px">
                <td colspan="4">
                    <a href="php/add_gas.php">Thêm sản phẩm</a>
                </td>
            </tr>
            <tr class="header">
                <td>Hình ảnh</td>
                <td>Tên</td>
                <td>Thương hiệu</td>
                <td>Trọng lượng vỏ</td>
                <td>Giá thành</td>
                <td>Thông tin</td>
                <td>Thao tác</td>
            </tr>
            <?php
                foreach($result_gas as $row) { ?>
                <tr class="item">
                    <td><img src="img/gas/<?php echo $row['HinhAnh'];?>"></td>
                    <td><?php echo $row['TenGas'];?></td>
                    <td><?php echo $row['ThuongHieu'];?></td>
                    <td><?php echo $row['TrongLuongVoBinh'];?></td>
                    <td><?php echo $row['GiaThanh'];?></td>
                    <td><?php echo $row['ThongTin'];?></td>
                    <td>
                        <a href="php/update_gas.php?id=<?php echo $row['GasID']; ?>">Chỉnh sửa</a> |
                        <a href="php/delete_gas.php?id=<?php echo $row['GasID']; ?>" class="delete-link">Xóa</a>
                    </td>
                </tr>
            <?php
                }
            ?>
            <tr class="control" style="font-weight: bold; font-size: 17px">
                <td colspan="7" style="text-align: right;">
                    <p class="mb-0">Số lượng sản phẩm: <?php echo mysqli_num_rows($result_gas); ?></p>
                </td>
            </tr>
            </table>
    </section>

    <!-- GẠO -->
    <section class="container my-5" id="gao">
        <div class="d-flex align-items-center justify-content-center mb-4">
            <div style="flex: 1; height: 1px; background-color: lightgray;"></div>
            <h3 class="mx-3 fw-bold mb-0" style="font-weight: bold;">GẠO</h3>
            <div style="flex: 1; height: 1px; background-color: lightgray;"></div>
        </div>
        <table class="custom-table">
            <tr class="control" style="text-align: left; font-weight: bold; font-size: 20px">
                <td colspan="4">
                    <a href="php/add_gao.php">Thêm sản phẩm</a>
                </td>
            </tr>
            <tr class="header">
                <td>Hình ảnh</td>
                <td>Tên</td>
                <td>Thương hiệu</td>
                <td>Loại gạo</td>
                <td>Trọng lượng</td>
                <td>Giá thành</td>
                <td>Thông tin</td>
                <td>Thao tác</td>
            </tr>
            <?php
                foreach($result_gao as $row) { ?>
                <tr class="item">
                    <td><img src="img/gao/<?php echo $row['HinhAnh'];?>"></td>
                    <td><?php echo $row['TenGao'];?></td>
                    <td><?php echo $row['ThuongHieu'];?></td>
                    <td><?php echo $row['LoaiGao'];?></td>
                    <td><?php echo $row['TrongLuong'];?></td>
                    <td><?php echo $row['GiaThanh'];?></td>
                    <td><?php echo $row['ThongTin'];?></td>
                    <td>
                        <a href="php/update_gao.php?id=<?php echo $row['GaoID']; ?>">Chỉnh sửa</a> |
                        <a href="php/delete_gao.php?id=<?php echo $row['GaoID']; ?>" class="delete-link">Xóa</a>
                    </td>
                </tr>
            <?php
                }
            ?>
            <tr class="control" style="font-weight: bold; font-size: 17px">
                <td colspan="8" style="text-align: right;">
                    <p class="mb-0">Số lượng sản phẩm: <?php echo mysqli_num_rows($result_gao); ?></p>
                </td>
            </tr>
        </table>
    </section>

    <!-- NƯỚC UỐNG -->
    <section class="container my-5" id="nuocuong">
        <div class="d-flex align-items-center justify-content-center mb-4">
            <div style="flex: 1; height: 1px; background-color: lightgray;"></div>
            <h3 class="mx-3 fw-bold mb-0" style="font-weight: bold;">NƯỚC UỐNG</h3>
            <div style="flex: 1; height: 1px; background-color: lightgray;"></div>
        </div>
        <div style="overflow-x: auto;">
            <table class="custom-table">
                <tr class="control" style="text-align: left; font-weight: bold; font-size: 20px">
                    <td colspan="4">
                        <a href="php/add_nuocuong.php">Thêm sản phẩm</a>
                    </td>
                </tr>
                <tr class="header">
                    <td>Hình ảnh</td>
                    <td>Tên</td>
                    <td>Thương hiệu</td>
                    <td>Thành phần</td>
                    <td>Dung tích</td>
                    <td>Quy cách</td>
                    <td>Chủng loại</td>
                    <td>Giá thành</td>
                    <td>Thông tin</td>
                    <td>Thao tác</td>
                </tr>
                <?php foreach($result_nuocuong as $row) { ?>
                    <tr class="item">
                        <td><img src="img/nuocuong/<?php echo $row['HinhAnh']; ?>"></td>
                        <td><?php echo $row['TenNuocUong']; ?></td>
                        <td><?php echo $row['ThuongHieu']; ?></td>
                        <td><?php echo $row['ThanhPhan']; ?></td>
                        <td><?php echo $row['DungTich']; ?></td>
                        <td><?php echo $row['QuyCach']; ?></td>
                        <td><?php echo $row['ChungLoai']; ?></td>
                        <td><?php echo $row['GiaThanh']; ?></td>
                        <td><?php echo $row['ThongTin']; ?></td>
                        <td>
                            <a href="php/update_nuocuong.php?id=<?php echo $row['NuocUongID']; ?>">Chỉnh sửa</a> |
                            <a href="php/delete_nuocuong.php?id=<?php echo $row['NuocUongID']; ?>" class="delete-link">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
                <tr class="control" style="font-weight: bold; font-size: 17px">
                    <td colspan="10" style="text-align: right;">
                        <p class="mb-0">Số lượng sản phẩm: <?php echo mysqli_num_rows($result_nuocuong); ?></p>
                    </td>
                </tr>
            </table>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="text-light text-center text-white py-4" style="background-color: #0d97d4; width: 100%; margin-top: auto;">
        <div class="container" style="background-color: #0d97d4;">
            <p class="mb-1 fs-6">Copyright 2025 &copy; <strong>Đại Lý Gas Gia Huy</strong>. Chuyên cung cấp Gas - Gạo - Nước uống tận nơi.</p>
            <p class="mb-0">Địa chỉ: 18/1 Cầu Bè, Vĩnh Thạnh, Nha Trang, Khánh Hòa. Hotline: 0258 389 1018</p>
        </div>
    </footer>

    <!-- Delete Confirm Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xóa sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc rằng muốn xóa sản phẩm này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <a href="#" id="confirmDelete" class="btn btn-danger">Xóa</a>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".delete-link").click(function (e) {
                e.preventDefault();
                var deleteUrl = $(this).attr("href");
                $("#confirmDelete").attr("href", deleteUrl);
                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
        });
    </script>

    <script src="js/admin.js"></script>
    <script src="js/scroll.js"></script>

</body>
</html>