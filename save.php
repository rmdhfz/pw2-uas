<?php 
	if ($_POST) {
		require_once 'connect.php';
		try {
			$name = $_POST['name'];
			$email = $_POST['email'];
            $no_telp = $_POST['no_telp'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$sql = "INSERT INTO penjual (nama, email, no_telp, password) VALUES ('$name', '$email', '$no_telp', '$password')";
			if (!$con->query($sql)) {
				echo $con->error;
			}else{
				echo json_encode("Berhasil insert data penjual");
			}
		} catch (Exception $ex){
			echo $ex;
		}
	}else{
		http_response_code(405); // method not allowed
	}
 ?>