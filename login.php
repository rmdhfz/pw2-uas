<!DOCTYPE html>
<html>
<head>
	<title>Toko Online - Login</title>
</head>
<body>
	<h2>Silahkan login terlebih dahulu</h2>
	<br/>
	<?php 
	if(isset($_GET['msg'])){
		if($_GET['msg'] == "failed"){
			echo "Login gagal! username dan password salah!";
		}else if($_GET['msg'] == "logout"){
			echo "Anda telah berhasil logout";
		}else if($_GET['msg'] == "login"){
			echo "Anda harus login untuk mengakses halaman admin";
		}
	}
	?>
	<br/>
	<br/>
	<form method="post" action="ceklogin.php">
		<table>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td><input type="email" name="email" placeholder="Masukkan email" required></td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td><input type="password" name="password" placeholder="Masukkan password" required></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><input type="submit" value="LOGIN"></td>
			</tr>
		</table>			
	</form>
</body>
</html>