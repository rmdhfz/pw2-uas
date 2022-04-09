<?php
	// host, username, password, database name.
	$con = new mysqli("localhost", "id18602861_user_tokoonline", "W@w?g!9YfkMVQ6Sq", "id18602861_tokoonline");
	if ($con->connect_errno) {
		echo "Failed to connect to MySQL: ".$con->connect_error;
		exit();
	}
?>