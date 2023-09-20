<?php
$data['ajaxSuccess'] = true;
$data['num'] = !empty($_POST['new_num']) ? $_POST['new_num'] : 1;
//$data['num'] = $_POST['new_num'];

if (isset($_SESSION['user_data']))
	$data['user_data'] = $_SESSION['user_data'];

if (!empty($link_registr))
	$data['link_registr'] = $link_registr;
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

$data['test'] = $_POST;

echo json_encode($data);
