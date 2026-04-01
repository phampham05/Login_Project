<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            echo "<script>
                    alert('Đăng nhập thành công!');
                    window.location.href='welcome.php';
                  </script>";
            exit();
        }
    }
    // Nếu thất bại
    echo "<script>
            alert('Đăng nhập thất bại!');
            window.history.back();
          </script>";
}
?>