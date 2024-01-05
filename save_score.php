<?php
session_start();
include 'connect.php'; // File kết nối tới cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mark'])) {
  // Lấy điểm số từ dữ liệu gửi lên
  $mark = $_POST['mark'];
  // Tên người dùng đã đăng nhập
  $username = $_SESSION['username'];

  // Truy vấn để chèn điểm số vào bảng 'diem_thi'
  $sql = "INSERT INTO diem_thi (username, diem) VALUES (:username, :diem)";

  // Sử dụng prepared statement để thực hiện truy vấn
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':diem', $mark);

  // Thực thi truy vấn
  if ($stmt->execute()) {
    // Gửi phản hồi về Ajax (nếu cần)
    echo 'Điểm số đã được lưu vào cơ sở dữ liệu.';
  } else {
    // Xử lý lỗi nếu có
    echo 'Đã xảy ra lỗi khi lưu điểm số.';
  }
}
?>
