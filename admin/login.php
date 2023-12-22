<?php
    session_start();
    ob_start();
    include "connect.php";
    include "user.php";

    if((isset($_POST['dangnhap']))&&($_POST['dangnhap'])){
        $user=$_POST['user'];
        $pass=$_POST['pass'];
        $role=checkuser($user,$pass);
        $_SESSION['role']=$role;
        if($role==1) header('location: index.php');
        else{
            $txt_erro="Username hoặc Password không tồn tại!";
        } //header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin</title>
    
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

</head>
<body>
    <div id="wrapper">
         <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="form-login">
            <h1 class="form-heading">ADMIN</h1>
            <div class="form-group">
                <i class="far fa-user"></i>
                <input  type="text" name="user" class="form-input"  id="" placeholder="Tên đăng nhập">
            </div>
                 <div class="form-group">
                     <i class="fas fa-key"></i>
                    <input type="password" name="pass"  class="form-input" id=""placeholder="Mật khẩu">
                    <div id="eye">
                    <i class="far fa-eye"></i>
                </div>
                    <input type="submit" name="dangnhap" class="form-submit" value="ĐĂNG NHẬP">
                    <?php
                        if(isset($txt_erro)&&($txt_erro!="")){
                            echo "<font color='red'>".$txt_erro."</font>";
                        }
                    ?>
                </form>
            </div>
        </div>
</div>
    
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="js/app.js"></script>
</html>