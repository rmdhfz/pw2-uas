<?php 
session_start();
include 'connect.php';
 
$email = $_POST['email'];
$password = $_POST['password'];
$data = mysqli_query($koneksi,"select * from penjual where email='$email' and password='$password'");
$cek = mysqli_num_rows($data); 
if($cek > 0){
	$_SESSION['email'] = $email;
	$_SESSION['status'] = "login";
	header("location:/tokoonline/");
}else{
	header("location:tokoonline/?msg=failed");
}
?>