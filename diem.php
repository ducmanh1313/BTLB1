<?php
// Điểm số của người dùng (giả sử đã lấy điểm số từ quá trình kiểm tra vào biến $mark)
$diem = $mark;

// Tên người dùng đã đăng nhập
$username = $_SESSION['username'];

// Truy vấn để chèn dữ liệu điểm số vào bảng 'diem_thi'
$sql = "INSERT INTO diem_thi (username, diem) VALUES (:username, :diem)";

// Sử dụng prepared statement để thực hiện truy vấn
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':diem', $diem);

// Thực thi truy vấn
$stmt->execute();

