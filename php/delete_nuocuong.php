<?php
require_once "./connect.php"; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    $stmt = $conn->prepare("DELETE FROM NuocUong WHERE NuocUongID = ?");
    if (!$stmt) {
        die("Lỗi kết nối cơ sở dữ liệu: " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: ../admin.php");
    exit();
} else {
    echo "ID sản phẩm không hợp lệ hoặc không được cung cấp!";
}
?>
