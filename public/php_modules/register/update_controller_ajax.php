<?php
	session_start();
	if(isset($_SESSION['user_data'])) {
		$data['user_data'] = $_SESSION['user_data'];
	}
	
    echo json_encode($data);
?>