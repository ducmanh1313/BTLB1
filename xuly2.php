<?php
//Khai báo sử dụng session
session_start();
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
//Xử lý đăng nhập
if (isset($_POST['dangnhap']))
{
//Kết nối tới database

$connect = mysqli_connect ('localhost', 'root', '', 'tracnghiem') or die ('Không thể kết nối tới database');
mysqli_set_charset($connect, 'UTF8');


//Lấy dữ liệu nhập vào
$username = addslashes($_POST['username']);
$password = addslashes($_POST['password']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$username || !$password) {
echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
  

  
//Kiểm tra tên đăng nhập có tồn tại không
$query = "SELECT username, password FROM member WHERE username='$username'";
$result = mysqli_query($connect, $query) or die( mysqli_error($connect));

if (!$result) {
    echo "Tên đăng nhập hoặc mật khẩu không đúng!";
} else {
    $row = mysqli_fetch_array($result);
    if ($password != $row['password']) {
        echo "Mật khẩu không đúng. Vui lòng nhập lại.";
    } else {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    }
}
}
?>