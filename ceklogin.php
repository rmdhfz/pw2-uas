<?php 
session_start();
include 'connect.php';
 
$email = $_POST['email'];
$password = $_POST['password'];
$data = mysqli_query($koneksi,"select * from penjual where email='$email'");
$cek = mysqli_num_rows($data); 
$res = mysqli_fetch_assoc($data);
if($cek > 0){
    $verify = password_verify($password, $res['password']);
    if ($verify) {
        $_SESSION['email'] = $email;
        $_SESSION['status'] = "login";
        header("location:/tokoonline/?msg=success");
    }else{
        header("location:/tokoonline/?msg=failed");
    }
}else{
	header("location:/tokoonline/?msg=failed");
}
?>