<?php
require_once "./connect.php";

$error = '';
$success = '';
$TenGas = $ThuongHieu = $ThongTin = '';
$TrongLuongVoBinh = 0.0;
$GiaThanh = '';
$HinhAnh = '';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID sản phẩm không hợp lệ hoặc không được cung cấp!");
}

$GasID = (int)$_GET['id'];

$result = $conn->query("SELECT * FROM Gas WHERE GasID = $GasID");
if ($result->num_rows == 0) {
    die("Không tìm thấy sản phẩm!");
}
$product = $result->fetch_assoc();

$TenGas = $product['TenGas'];
$ThuongHieu = $product['ThuongHieu'];
$TrongLuongVoBinh = $product['TrongLuongVoBinh'];
$GiaThanh = $product['GiaThanh'];
$ThongTin = $product['ThongTin'];
$HinhAnh = $product['HinhAnh'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $TenGas = trim($_POST['TenGas']);
    $ThuongHieu = trim($_POST['ThuongHieu']);
    $TrongLuongVoBinh = (float)trim($_POST['TrongLuongVoBinh']);
    $GiaThanh = trim($_POST['GiaThanh']);
    $ThongTin = trim($_POST['ThongTin']);
    $new_image = $HinhAnh;

    if (empty($TenGas)) {
        $error = 'Hãy nhập tên gas.';
    } elseif (empty($ThuongHieu)) {
        $error = 'Hãy nhập thương hiệu.';
    } elseif ($TrongLuongVoBinh <= 0) {
        $error = 'Trọng lượng vỏ bình phải lớn hơn 0.';
    } elseif (empty($GiaThanh)) {
        $error = 'Giá thành không được để trống.';
    } elseif (empty($ThongTin)) {
        $error = 'Hãy nhập thông tin mô tả.';
    } else {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $target_dir = __DIR__ . '/../img/gas/';
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_name = basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $allowed_types = ["jpg", "jpeg", "png"];
            if (!in_array($imageFileType, $allowed_types)) {
                $error = "Chỉ chấp nhận các định dạng JPG, JPEG, PNG.";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $new_image = $file_name;
                } else {
                    $error = "Không thể tải lên ảnh mới.";
                }
            }
        }

        if (empty($error)) {
            $stmt = $conn->prepare("UPDATE Gas SET TenGas = ?, ThuongHieu = ?, TrongLuongVoBinh = ?, GiaThanh = ?, ThongTin = ?, HinhAnh = ? WHERE GasID = ?");
            if (!$stmt) {
                $error = "Lỗi CSDL: " . $conn->error;
            } else {
                $stmt->bind_param("ssdsssi", $TenGas, $ThuongHieu, $TrongLuongVoBinh, $GiaThanh, $ThongTin, $new_image, $GasID);
                if ($stmt->execute()) {
                    $success = "Cập nhật sản phẩm thành công!";
                    $HinhAnh = $new_image;
                } else {
                    $error = "Lỗi khi cập nhật dữ liệu: " . $stmt->error;
                }
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật sản phẩm gas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 border rounded my-5 p-4 mx-3">
            <p><a href="../admin.php">Quay lại</a></p>
            <h3 class="text-center">Cập nhật sản phẩm</h3>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="TenGas">Tên sản phẩm</label>
                    <input value="<?= htmlspecialchars($TenGas) ?>" name="TenGas" required class="form-control" type="text">
                </div>
                <div class="form-group">
                    <label for="ThuongHieu">Thương hiệu</label>
                    <input value="<?= htmlspecialchars($ThuongHieu) ?>" name="ThuongHieu" required class="form-control" type="text">
                </div>
                <div class="form-group">
                    <label for="TrongLuongVoBinh">Trọng lượng vỏ bình</label>
                    <input value="<?= htmlspecialchars($TrongLuongVoBinh) ?>" name="TrongLuongVoBinh" required class="form-control" type="number" step="0.1">
                </div>
                <div class="form-group">
                    <label for="GiaThanh">Giá thành</label>
                    <input value="<?= htmlspecialchars($GiaThanh) ?>" name="GiaThanh" required class="form-control" type="text">
                </div>
                <div class="form-group">
                    <label for="ThongTin">Thông tin mô tả</label>
                    <textarea name="ThongTin" rows="4" class="form-control"><?= htmlspecialchars($ThongTin) ?></textarea>
                </div>
                <div class="form-group">
                    <label>Ảnh hiện tại:</label><br>
                    <img src="../img/gas/<?= htmlspecialchars($HinhAnh) ?>" style="max-height: 120px;">
                </div>
                <div class="form-group">
                    <label>Chọn ảnh mới (nếu muốn thay)</label>
                    <div class="custom-file">
                        <input name="image" type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary px-5">Cập nhật</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
</body>
</html>
