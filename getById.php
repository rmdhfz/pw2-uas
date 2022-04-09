<?php 
	if ($_POST) {
		try {
			$id = $_POST['id'];
			if ($id) {
				require_once 'connect.php';
				$get = $con->query("SELECT * FROM penjual WHERE id = '$id'");
				if (!$get) {
					echo $con->error();
				}else{
					if ($get->num_rows > 0) {
						$data = mysqli_fetch_object($get);
						$resp = [
							'data'	=>	$data,
						];
						echo json_encode($resp);
					}else{
						echo json_encode(null);
					}
				}
			}else{
				http_response_code(400); // bad request
			}
		} catch (Exception $ex) {
			echo $ex;
		}
	}else{
		http_response_code(405); // method not allowed 
	}
 ?>