<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']); // loại bỏ khoảng trắng
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Kiểm tra xem username đã tồn tại chưa
    $check_sql = "SELECT id FROM users WHERE username = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Username đã tồn tại
        echo "<script>
                alert('Tên người dùng đã tồn tại. Vui lòng chọn tên khác!');
                window.history.back();
              </script>";
        exit();
    }

    // Nếu username chưa tồn tại, chèn vào DB
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "<script>
                alert('Đăng ký thành công!');
                window.location.href='login.html';
              </script>";
    } else {
        // Nếu xảy ra lỗi khác
        $error = $stmt->error;
        echo "<script>
                alert('Đăng ký thất bại! Lỗi: $error');
                window.history.back();
              </script>";
    }
}
?>