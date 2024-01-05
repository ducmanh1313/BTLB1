<?php
session_start();

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header('Location: login.php');
    exit();
}

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tracnghiem";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    // Thiết lập chế độ báo lỗi cho PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lấy thông tin điểm thi của người dùng hiện tại
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM diem_thi WHERE username=:username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
}
?>
<?php
if ($stmt->rowCount() > 0) {
    echo "<h1>Lịch sử điểm thi của bạn</h1>";
    echo "<table border='1'>
    <tr>
      <th>ID</th>
      <th>Tên người dùng</th>
      <th>Điểm</th>
      <th>Thời gian</th>
    </tr>";
    // Hiển thị thông tin điểm thi
    foreach ($results as $row) {
        echo "<tr>
        <td>".$row['id']."</td>
        <td>".$row['username']."</td>
        <td>".$row['diem']."</td>
        <td>".$row['timestamp']."</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "<h1>Không có dữ liệu điểm thi.</h1>";
}
?>