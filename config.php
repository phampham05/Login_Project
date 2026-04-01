<?php
$host = "localhost";
$dbname = "test";
$user = "root"; 
$pass = "";     

// Tạo kết nối
$conn = new mysqli($host, $user, $pass, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>