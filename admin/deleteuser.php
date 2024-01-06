<?php
include('connect.php');

try {
    // Kiểm tra xem có giá trị id được gửi từ form không
    if(isset($_POST['id'])) {
        $id = $_POST['id'];

        // Sử dụng Prepared Statements để xóa người dùng
        $sql = "DELETE FROM member WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            echo "Xóa người dùng thành công!";
        } else {
            echo "Xóa người dùng thất bại!";
        }
    } else {
        echo "Không có ID người dùng được cung cấp!";
    }
} catch (PDOException $e) {
    echo "Lỗi xóa người dùng: " . $e->getMessage();
}
?>
