<?php
require_once "./connect.php";

$error = '';
$success = '';
$TenNuocUong = $ThuongHieu = $ThanhPhan = $QuyCach = $ChungLoai = $ThongTin = '';
$DungTich = 0.0;
$GiaThanh = '';
$HinhAnh = '';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID sản phẩm không hợp lệ hoặc không được cung cấp!");
}

$NuocUongID = (int)$_GET['id'];

$result = $conn->query("SELECT * FROM NuocUong WHERE NuocUongID = $NuocUongID");
if ($result->num_rows == 0) {
    die("Không tìm thấy sản phẩm!");
}
$product = $result->fetch_assoc();

$TenNuocUong = $product['TenNuocUong'];
$ThuongHieu = $product['ThuongHieu'];
$ThanhPhan = $product['ThanhPhan'];
$DungTich = $product['DungTich'];
$QuyCach = $product['QuyCach'];
$ChungLoai = $product['ChungLoai'];
$GiaThanh = $product['GiaThanh'];
$ThongTin = $product['ThongTin'];
$HinhAnh = $product['HinhAnh'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $TenNuocUong = trim($_POST['TenNuocUong']);
    $ThuongHieu = trim($_POST['ThuongHieu']);
    $ThanhPhan = trim($_POST['ThanhPhan']);
    $DungTich = (float)trim($_POST['DungTich']);
    $QuyCach = trim($_POST['QuyCach']);
    $ChungLoai = trim($_POST['ChungLoai']);
    $GiaThanh = (int)trim($_POST['GiaThanh']);
    $ThongTin = trim($_POST['ThongTin']);
    $new_image = $HinhAnh;

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
    } elseif (empty($GiaThanh) || (int)$GiaThanh <= 0) {
        $error = 'Giá thành phải là số và lớn hơn 0.';
    } elseif (empty($ThongTin)) {
        $error = 'Hãy nhập thông tin mô tả.';
    } else {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $target_dir = __DIR__ . '/../img/nuocuong/';
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_name = basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ["jpg", "jpeg", "png"];

            if (!in_array($imageFileType, $allowed_types)) {
                $error = "Chỉ chấp nhận định dạng JPG, JPEG, PNG.";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $new_image = $file_name;
                } else {
                    $error = "Không thể tải ảnh mới.";
                }
            }
        }

        if (empty($error)) {
            $stmt = $conn->prepare("UPDATE NuocUong SET TenNuocUong=?, ThuongHieu=?, ThanhPhan=?, DungTich=?, QuyCach=?, ChungLoai=?, GiaThanh=?, ThongTin=?, HinhAnh=? WHERE NuocUongID=?");
            if (!$stmt) {
                $error = "Lỗi CSDL: " . $conn->error;
            } else {
                $stmt->bind_param("sssdssissi", $TenNuocUong, $ThuongHieu, $ThanhPhan, $DungTich, $QuyCach, $ChungLoai, $GiaThanh, $ThongTin, $new_image, $NuocUongID);
                if ($stmt->execute()) {
                    $success = "Cập nhật sản phẩm thành công!";
                    $HinhAnh = $new_image;
                } else {
                    $error = "Lỗi khi cập nhật: " . $stmt->error;
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
    <title>Cập nhật nước uống</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 border rounded my-5 p-4 mx-3">
            <p><a href="../admin.php">Quay lại</a></p>
            <h3 class="text-center">Cập nhật nước uống</h3>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tên nước uống</label>
                    <input name="TenNuocUong" type="text" class="form-control" required value="<?= htmlspecialchars($TenNuocUong) ?>">
                </div>
                <div class="form-group">
                    <label>Thương hiệu</label>
                    <input name="ThuongHieu" type="text" class="form-control" required value="<?= htmlspecialchars($ThuongHieu) ?>">
                </div>
                <div class="form-group">
                    <label>Thành phần</label>
                    <input name="ThanhPhan" type="text" class="form-control" required value="<?= htmlspecialchars($ThanhPhan) ?>">
                </div>
                <div class="form-group">
                    <label>Dung tích (ml hoặc l)</label>
                    <input name="DungTich" type="number" step="0.01" class="form-control" required value="<?= htmlspecialchars($DungTich) ?>">
                </div>
                <div class="form-group">
                    <label>Quy cách</label>
                    <input name="QuyCach" type="text" class="form-control" required value="<?= htmlspecialchars($QuyCach) ?>">
                </div>
                <div class="form-group">
                    <label>Chủng loại</label>
                    <input name="ChungLoai" type="text" class="form-control" required value="<?= htmlspecialchars($ChungLoai) ?>">
                </div>
                <div class="form-group">
                    <label>Giá thành (VNĐ)</label>
                    <input name="GiaThanh" type="number" step="1000" class="form-control" required value="<?= htmlspecialchars($GiaThanh) ?>">
                </div>
                <div class="form-group">
                    <label>Thông tin mô tả</label>
                    <textarea name="ThongTin" rows="4" class="form-control"><?= htmlspecialchars($ThongTin) ?></textarea>
                </div>
                <div class="form-group">
                    <label>Ảnh hiện tại:</label><br>
                    <img src="../img/nuocuong/<?= htmlspecialchars($HinhAnh) ?>" style="max-height: 120px;">
                </div>
                <div class="form-group">
                    <label>Chọn ảnh mới (nếu muốn thay)</label>
                    <div class="custom-file">
                        <input name="image" type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                    </div>
                </div>
                <div class="form-group text-center mt-3">
                    <button type="submit" class="btn btn-primary px-5">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelector(".custom-file-input").addEventListener("change", function () {
        const fileName = this.value.split("\\").pop();
        this.nextElementSibling.innerHTML = fileName;
    });
</script>
</body>
</html>
