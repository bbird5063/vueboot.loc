<?php
	// $data['contentIn'] если нужно, уже определен
	$data['num'] = !empty($_POST['new_num']) ? $_POST['new_num'] : 1;
	
	if (isset($_SESSION['user_data']))
	$data['user_data'] = $_SESSION['user_data'];
	
	if (!empty($reg_error))
	$data['reg_error'] = $reg_error;
	if (!empty($reg_info))
	$data['reg_info'] = getInfo($reg_info);
	
	echo json_encode($data);
