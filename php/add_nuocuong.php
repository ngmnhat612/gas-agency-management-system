<?php
require_once "./connect.php";

$error = '';
$success = '';
$TenNuocUong = $ThuongHieu = $ThanhPhan = $QuyCach = $ChungLoai = $GiaThanh = $ThongTin = '';
$DungTich = 0.0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $TenNuocUong = trim($_POST['TenNuocUong']);
    $ThuongHieu = trim($_POST['ThuongHieu']);
    $ThanhPhan = trim($_POST['ThanhPhan']);
    $DungTich = (float)trim($_POST['DungTich']);
    $QuyCach = trim($_POST['QuyCach']);
    $ChungLoai = trim($_POST['ChungLoai']);
    $GiaThanh = (int)trim($_POST['GiaThanh']);
    $ThongTin = trim($_POST['ThongTin']);

    if (empty($TenNuocUong)) {
        $error = 'Hãy nhập tên nước uống.';
    } elseif (empty($ThuongHieu)) {
        $error = 'Hãy nhập thương hiệu.';
    } elseif (empty($ThanhPhan)) {
        $error = 'Hãy nhập thành phần.';
    } elseif ($DungTich <= 0) {
        $error = 'Dung tích phải lớn hơn 0.';
    } elseif (empty($QuyCach)) {
        $error = 'Hãy nhập quy cách.';
    } elseif (empty($ChungLoai)) {
        $error = 'Hãy nhập chủng loại.';
    } elseif (empty($GiaThanh) || $GiaThanh <= 0) {
        $error = 'Giá thành phải lớn hơn 0.';
    } elseif (empty($ThongTin)) {
        $error = 'Hãy nhập thông tin mô tả.';
    } elseif (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
        $error = "Hãy chọn ảnh minh họa hợp lệ.";
    } else {
        $targetDir = __DIR__ . '/../img/nuocuong/';
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

        $imageName = basename($_FILES["image"]["name"]);
        $uploadPath = $targetDir . $imageName;
        $imageFileType = strtolower(pathinfo($uploadPath, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png"];

        if (!in_array($imageFileType, $allowedTypes)) {
            $error = "Chỉ chấp nhận định dạng JPG, JPEG, PNG.";
        } elseif (!move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath)) {
            $error = "Không thể tải ảnh lên. Kiểm tra quyền thư mục hoặc tên file.";
        } else {
            $stmt = $conn->prepare("INSERT INTO NuocUong (TenNuocUong, ThuongHieu, ThanhPhan, DungTich, QuyCach, ChungLoai, GiaThanh, ThongTin, HinhAnh) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                $error = "Lỗi kết nối cơ sở dữ liệu: " . $conn->error;
            } else {
                $stmt->bind_param("sssdssdss", $TenNuocUong, $ThuongHieu, $ThanhPhan, $DungTich, $QuyCach, $ChungLoai, $GiaThanh, $ThongTin, $imageName);
                if ($stmt->execute()) {
                    $success = "Sản phẩm đã được thêm thành công!";
                    $TenNuocUong = $ThuongHieu = $ThanhPhan = $QuyCach = $ChungLoai = $ThongTin = '';
                    $DungTich = $GiaThanh = '';
                } else {
                    $error = "Lỗi khi thêm dữ liệu: " . $stmt->error;
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Thêm sản phẩm nước uống</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 border rounded my-5 p-4 mx-3">
            <p class="mb-4"><a href="../admin.php">Quay lại</a></p>
            <h3 class="text-center text-secondary mb-4">Thêm sản phẩm nước uống</h3>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php elseif ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="TenNuocUong">Tên nước uống</label>
                    <input type="text" class="form-control" id="TenNuocUong" name="TenNuocUong" required value="<?= htmlspecialchars($TenNuocUong) ?>">
                </div>

                <div class="form-group">
                    <label for="ThuongHieu">Thương hiệu</label>
                    <input type="text" class="form-control" id="ThuongHieu" name="ThuongHieu" required value="<?= htmlspecialchars($ThuongHieu) ?>">
                </div>

                <div class="form-group">
                    <label for="ThanhPhan">Thành phần</label>
                    <input type="text" class="form-control" id="ThanhPhan" name="ThanhPhan" required value="<?= htmlspecialchars($ThanhPhan) ?>">
                </div>

                <div class="form-group">
                    <label for="DungTich">Dung tích (ml hoặc l)</label>
                    <input type="number" class="form-control" id="DungTich" name="DungTich" step="0.1" required value="<?= htmlspecialchars($DungTich) ?>">
                </div>

                <div class="form-group">
                    <label for="QuyCach">Quy cách</label>
                    <input type="text" class="form-control" id="QuyCach" name="QuyCach" required value="<?= htmlspecialchars($QuyCach) ?>" placeholder="Thùng 24 chai/Bình có vòi/Bình không vòi">
                </div>

                <div class="form-group">
                    <label for="ChungLoai">Chủng loại</label>
                    <input type="text" class="form-control" id="ChungLoai" name="ChungLoai" required value="<?= htmlspecialchars($ChungLoai) ?>" placeholder="Chai/Bình">
                </div>

                <div class="form-group">
                    <label for="GiaThanh">Giá thành (VNĐ)</label>
                    <input type="number" class="form-control" id="GiaThanh" name="GiaThanh" step="1000" required min="0" value="<?= htmlspecialchars($GiaThanh) ?>">
                </div>

                <div class="form-group">
                    <label for="ThongTin">Thông tin sản phẩm</label>
                    <textarea class="form-control" id="ThongTin" name="ThongTin" rows="4" required><?= htmlspecialchars($ThongTin) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="customFile">Ảnh minh họa</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="image" accept="image/*" required>
                        <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                    </div>
                </div>

                <div class="form-group text-center mt-4">
                    <button type="submit" class="btn btn-primary px-5">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(".custom-file-input").on("change", function () {
        let fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
</body>
</html>
