<!DOCTYPE html> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<link rel="stylesheet" href="css/login.css"/> 
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
</head> 
<body> 
    <form action='login.php' class="dangnhap" method='POST'> 
            <h1 class="heading">Đăng nhập</h1>
            Tên đăng nhập : <input type='text' name='username' /> 
            Mật khẩu : <input type='password' name='password' /> 
            <div id="eye">
            <i class="far fa-eye"></i>
            <input type='submit' class="button" name="dangnhap" value='Đăng nhập' /> 
            <a href='register.php' title='Đăng ký'>Đăng ký</a> 
        <?php require 'xuly2.php';?> 
    <form> 
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="./admin/js/app.js"></script> 
</html>