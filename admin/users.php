<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tracnghiem";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$query = "SELECT * FROM member";
$result = $connection->query($query);

// Kiểm tra và gán dữ liệu cho biến $members
if ($result) {
    $members = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $members = []; // Gán một mảng trống nếu không có dữ liệu
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trang quản lý tài khoản</title>
    <!-- Gọi các file CSS và JS của Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h1 class="mt-4">Bảng quản lý tài khoản người dùng</h1>

    <!-- Phần tìm kiếm -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" class="form-control" id="txtSearch" placeholder="Tìm kiếm...">
        </div>
    </div>

    <!-- Bảng hiển thị -->
    <!-- Bảng hiển thị -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên người dùng</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Thao tác</th> <!-- Thêm cột mới để hiển thị nút Sửa và Xóa -->
        </tr>
    </thead>
    <tbody id="userData">
        <?php foreach ($members as $member): ?>
            <tr>
                <td><?= $member['id']; ?></td>
                <td><?= $member['username']; ?></td>
                <td><?= $member['email']; ?></td>
                <td><?= $member['phone']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $member['id']; ?>" class="btn btn-primary">Sửa</a>
                    <a href="deleteuser.php?id=<?= $member['id']; ?>" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
</body>
</html>
