<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chào mừng</title>
</head>
<body>
    <h1>Chào mừng, <?php echo $_SESSION['username']; ?>!</h1>
    <a href="logout.php">Đăng xuất</a>
</body>
</html>