<?php
	
	/**
		* The block of initialization and processing of entering variables
		* Блок инициализации и обработки входящих переменных
		* @author IT studio IRBIS-team
		* @copyright © 2009 IRBIS-team
	*/
	/////////////////////////////////////////////////////////
	
	/**
		* Generation of page of an error at access out of system
		* Генерация страницы ошибки при доступе вне системы
	*/
	if(!defined('BBR_KEY'))
	header('http://'. $_SERVER['HTTP_HOST']);      
	/////////////////////////////////////////////////////////
	
	/** 
		* We kill magic inverted commas 
		* Убиваем магические кавычки 
	*/         
	function stripslashesDeep($data)     
	{     
		if(is_array($data))      
		$data = array_map("stripslashesDeep", $data); /* Применяет callback-функцию ко всем элементам указанных массивов */     
		else    
		$data = stripslashes($data); /* Удаляет экранирование символов. Функцию stripslashes() можно использовать, если экранирование символов не требуется. Например, данные не вставляются в базу данных, а просто выводятся в браузер. */
		return $data; 
	} 
	
	//if(get_magic_quotes_gpc()) /* Она удалена, потому что удалены сами магические кавычки. Уже давно php не проставляет автоматом слешей перед кавычками/апострафами. */
	//{  
	$_GET = stripslashesDeep($_GET);   
	$_POST = stripslashesDeep($_POST);   
	$_COOKIE = stripslashesDeep($_COOKIE);  
	//} 
	
	
	/**  
		* Buttons  
		* Кнопки  
	*/   
	$ok       = !empty($_POST['ok'])?true:false;  
	$delete   = !empty($_POST['delete'])?true:false;
	
	/**  
		* Other variables  
		* Другие переменные  
	*/    
	$title       = '';  
	$keywords    = '';  
	$description = ''; 
	$error       = '';  
	$dbError = array();
	$info        = array();
	$info_page   = array();
	
	$reg_error       = '';  
	$reg_info        = array();
	$reg_info_page   = array();
	$info_in         = '';
	$info_page_in    = '';
