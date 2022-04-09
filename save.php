<?php 
	if ($_POST) {
		require_once 'connect.php';
		try {
			$name = $_POST['name'];
			$email = $_POST['email'];
            $no_telp = $_POST['no_telp'];
			$sql = "INSERT INTO penjual (name, email, no_telp) VALUES ('$name', '$email', '$no_telp')";
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