<?php
function connect(){
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=tracnghiem", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn; // Trả về kết nối PDO
    } catch(PDOException $e) {
        // Ném ra ngoại lệ nếu có lỗi kết nối
        throw new PDOException("Connection failed: " . $e->getMessage());
    }
}
function checkuser($user,$pass){
    $conn=connect();
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE user='".$user."' AND pass='".$pass."'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq=$stmt->fetchAll();
    if(count($kq)>0) return $kq[0]['role'];
    else return 0;
}
function getuserinfo($user,$pass){
    $conn=connect();
    $sql="SELECT * FROM tbl_user WHERE user='".$user."' AND pass='".$pass."'";
    echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq=$stmt->fetchAll();
    return $kq;
}

?>