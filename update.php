<?php 
	if ($_POST) {
		$id = $_POST['id'];
		if ($id) {
			$name = $_POST['name'];
			$email = $_POST['email'];
            $no_telp = $_POST['no_telp'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
			if ($name && $email) {
				require_once 'connect.php';
				try {
					$sql = "UPDATE penjual SET nama = '$name', email = '$email', no_telp = '$no_telp', password = '$password' WHERE id = '$id'";
					if (!$con->query($sql)) {
						echo $con->error;
					}else{
						echo json_encode("Berhasil update data penjual");
					}
				} catch (Exception $ex) {
					echo $ex;
				}
			}
		}else{
			http_response_code(400); // bad request
		}
	}else{
		http_response_code(405); // method not allowed
	}

 ?>