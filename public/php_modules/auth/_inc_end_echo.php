<?php
$data['num'] = !empty($_POST['new_num']) ? $_POST['new_num'] : 1;

if (isset($_SESSION['user_data']))
	$data['user_data'] = $_SESSION['user_data'];

if (!empty($reg_error))
	$data['reg_error'] = $reg_error;
if (!empty($reg_info))
	$data['reg_info'] = getInfo($reg_info);
if (!empty($reg_info_page))
	$data['reg_info_page'] = getInfo($reg_info_page);
if (!empty($info_in))
	$data['info_in'] = $info_in;
if (!empty($info_page_in))
	$data['info_page_in'] = $info_page_in;

echo json_encode($data);
