<?php
// Kết nối đến cơ sở dữ liệu
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn để lấy thông tin của thành viên cần chỉnh sửa
    $query = "SELECT * FROM member WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $member = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Xử lý khi người dùng submit form chỉnh sửa thông tin thành viên
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Truy vấn cập nhật thông tin thành viên
    $query = "UPDATE member SET username = :username, email = :email, phone = :phone WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);

    if ($stmt->execute()) {
        // Chuyển hướng về trang quản lý tài khoản sau khi cập nhật thông tin
        header('Location: users.php');
        exit;
    } else {
        echo "Có lỗi xảy ra khi cập nhật thông tin thành viên.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa thông tin thành viên</title>
    <!-- Gọi các file CSS và JS của Bootstrap -->
    <!-- Các file CSS và JS -->
</head>
<body>
    <h1>Sửa thông tin thành viên</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $member['id']; ?>">
        <input type="text" name="username" value="<?= $member['username']; ?>">
        <input type="text" name="email" value="<?= $member['email']; ?>">
        <input type="text" name="phone" value="<?= $member['phone']; ?>">
        <button type="submit">Lưu thay đổi</button>
    </form>
</body>
</html>
