<?php
	
	/* Заменяем $ok т.к. в variables.php: $ok = !empty($POST['ok'])?true:false; , 
	а в Ajax и "<button name="ok"...":	$POST['ok'] не передается */
	// $ok = !empty($POST)?true:false; 
	
	////////////////////////////////////////////////////////////////////
	
	/**
		* Password change controller.
		* Контроллер изменения пароля.
		* @author IT studio IRBIS-team
		* @copyright © 2009 IRBIS-team
	*/
	////////////////////////////////////////////////////////// 
	
	/** 
		* We connect a file of the MySQL functions 
		* Подключаем файл функций MySQL 
	*/   
	//include_once './mysql.php'; 
	
	/**   
		* Check of the entered data   
		* Проверка введенных данных  
	*/         
	
	require '_inc_first.php';
	
	if($ok)  
	{  
		require 'mysql.php';   
		require 'functions.php';            

		if($POST['new_num'] == 3 && !$POST['password'])
		$reg_info[] = 'Введите пароль!'; 
		if(!$POST['password1'] || !$POST['password2'])  
		$reg_info[] = 'Введите пароль!'; 
		elseif(mb_strlen($POST['password1']) < 8)  
		$reg_info[] = 'Пароли должны содержать не менее восьми символов!';   
		elseif($POST['password1'] !== $POST['password2'])  
		$reg_info[] = 'Пароли не совпадают!';  
		
		/**   
			*   
			* Проверка старого пароля   
		*/
		if(!count($reg_info) && $POST['new_num'] == 3) {
			$res = mysqlQuery("SELECT *  
			FROM `" . BBR_DBPREFIX . "user`  
			WHERE `id` = " . $POST['id']);
			
			if (mysqli_num_rows($res) > 0) {
				mysqli_data_seek($res, 0); 
				$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
				if(md5($POST['password'] . BBR_SALT) !== $row['password']) {
					$reg_info[] = 'Текущий пароль не совпадает!';
				}	
			}
		}
		
		/**   
			*   
			* Установка нового пароля   
		*/
		if(!count($reg_info))  
		{ 
			
			//include_once './modules/register/functions.php';  
			mysqlQuery("UPDATE `". BBR_DBPREFIX ."user`    
			SET  `password` = '". md5($POST['password1'] . BBR_SALT) ."'   
			WHERE `id` = '". $_SESSION['user_data']['id'] ."'   
			") ;             
			
			// $POST['new_num'] = 0;
			//$data['contentIn'] = $for_contentIn[''];
			//reDirect('reg=off', 'id=0', 'num=0');
		} 
	}
	
	////////////////////////////////////////////////////////////////////
	/*
		"#login-modal-content"
		"#signup-modal-content"
		"#forgot-password-modal-content"
		"#code-modal-content"
		"#password-modal-content"
		"#user-modal-content"
	*/
	// require '_inc_menu.php';
	require '_inc_end_echo.php';
	
?>