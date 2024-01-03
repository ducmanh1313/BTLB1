<?php
session_start();

// Xóa tên người dùng khỏi session để đăng xuất
if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
}

// Chuyển hướng người dùng đến trang chủ hoặc trang khác sau khi đăng xuất
header("Location: login.php"); // Thay đổi index.php thành trang bạn muốn người dùng được chuyển hướng đến
exit();
?>
