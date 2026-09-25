<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dailygiahuy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_errno) {
    die("Kết nối MySQL lỗi: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
