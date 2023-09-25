<?php
	//require '../../require_ajax.php';
	require '../../require_ajax.php';
	
	/* Заменяем $ok т.к. в variables.php: $ok = !empty($_POST['ok'])?true:false; , 
	а в Ajax и "<button name="ok"...":	$_POST['ok'] не передается */
	$ok = !empty($_POST)?true:false; 
	
	////////////////////////////////////////////////////////////////////
	
	/** 
		* Registration (the controller of creation of the accounting record) 
		* Регистрация (контроллер создания учетной записи) 
		* @author IT studio IRBIS-team 
		* @copyright © 2009 IRBIS-team 
	*/ 
	///////////////////////////////////////////////////////// 
	
	/** 
		* Generation of page of an error at access out of system 
		* Генерация страницы ошибки при доступе вне системы 
	*/ 
	if(!defined('BBR_KEY')) 
	{ 
		header("HTTP/1.1 404 Not Found");       
		exit(file_get_contents('../../404.html')); 
	}  
	////////////////////////////////////////////////////////// 
	
	/** 
		* We connect a file of the MySQL functions 
		* Подключаем файл функций MySQL 
	*/   
	require '../../libs/mysql.php';  
	
	/**   
		* Check of the entered data   
		* Проверка введенных данных  
	*/         
	
	if($ok)  
	{  
		if(!$POST['login'])  
		$reg_info[] = 'Вы не ввели логин.';  
		elseif(mb_strlen($POST['login']) > 30)  
		$reg_info[] = 'Длина логина не должна превышать 30 символов';  
		
		if(!$POST['password'])  
		$reg_info[] = 'Введите пароль.'; 
		elseif(mb_strlen($POST['password']) < 8)  
		$reg_info[] = 'Пароли должны содержать не менее восьми символов.';   
		elseif($POST['password'] !== $POST['password2'])  
		$reg_info[] = 'Пароли не совпадают!';  
		
		if(!$POST['email'])  
		$reg_info[] = 'Для восстановления пароля нужен почтовый адрес.'; 
		elseif(!preg_match("/^[a-z0-9_.-]+@([a-z0-9]+.)+[a-z]{2,6}$/i", $POST['email']))  
		$reg_info[] = 'Не верный формат E-mail';         
		
		
		$res = mysqlQuery("SELECT *   
		FROM `". BBR_DBPREFIX ."user`   
		WHERE `login` = '". escapeString($POST['login']) ."'"  
		);  
		
		if(mysqli_num_rows($res) > 0)
		{	
			
			mysqli_data_seek($res, 0); // Перемещает указатель результата на выбранную (0) строку
	 		$row = mysqli_fetch_array($res, MYSQLI_ASSOC);  // получаем массив из 1(0) строки
			
			$addstr = '';
			if(empty($row['activate']) && !empty($row['email']) && $row['email'] == trim($POST['email']))
			{
				/*$addstr = ' с e-mail: <b>' . $row['email'] . '</b>, но он не активирован! <br>Активировать?<br><br><a href=' . href('reg=restoration','id=0' ,'num=2') . '>Активация</a><br><br>';*/
				/*$addstr = ' с e-mail: <b>' . $row['email'] . '</b>, но он не активирован! <br>Активировать?<br><br><a id="forgotModal-num_1" href="javascript:void(0)">Активация</a><br><br>';*/
				
				$POST['new_num'] = 2;
				
				$addstr = " с e-mail: <b>" . $row['email'] . "</b>, но он не активирован! <br>Активировать?<br><br><a id='forgotModal-num_1' href='javascript:void(0)'>Активация</a><br><br>";
				$_SESSION['login'] = $row['login'];
				$_SESSION['email'] = $row['email'];
			}
			$reg_info[] = 'Есть у нас уже один <b>'. htmlspecialchars($POST['login']) . '!</b><br>' . $addstr;
			$POST['login'] = '';
		}
		
		/**   
			* Registration of the new user   
			* Регистрация нового пользователя   
		*/          
		if(!count($reg_info))  
		{ 
			
			require './functions.php';  
			
			
			$res = mysqlQuery("INSERT INTO `". BBR_DBPREFIX ."user`  
			SET 
			`login`    = '". escapeString($_POST['login']) ."',  
			`password` = '". md5($_POST['password'] . BBR_SALT) ."',   
			`email`    = '". escapeString($_POST['email']) ."'"); 
 			
			$id =  mysqli_insert_id($_SESSION['db_connect']);              
			$hash = md5(randStr() . $id);  
			
			mysqlQuery("UPDATE `". BBR_DBPREFIX ."user`    
			SET  `hash` = '". $hash ."'   
			WHERE `id` = '". $id ."'   
			") ;             
			$_SESSION['email'] = $_POST['email']; /*  activate_controller.php: 'На почтовый адрес ' . (isset($_SESSION['email'])? ... */
			$subject = "Активация учетной записи";       
			$message = "С Вашего электронного почтового адреса поступила заявка на 
			aктивацию учетной записи на сайте <b>". $_SERVER['HTTP_HOST'] ."</b><br>\n 
			Для доступа в аккаунт пройдите по <a href=\"". 
			href("reg=activate", "id=$hash", "num=1") ."\" >этой ссылке</a><br /> 
			и введите в поле активации этот код: <b>". $hash ."</b><br>\n 
			Код действителен до ". date('d.m.Y', time() + 60 * 60 * 24 * 10); 
			
			$_POST['new_num'] = 1;
			
			if(BBR_DBSERVER == 'localhost')
			{
				file_put_contents('../../' . $subject . '.html', $message);
			}
			else
			{
				require '../../libs/bbr_mailer.php';    
				$mail = new BBR_Mailer($message); 
				
				$mail -> createTo($_POST['email']);  
				$mail -> createSubject($subject);  
				$mail -> createFrom(BBR_SUPPORT_EMAIL, BBR_SUPPORT_EMAIL); 
				$mail -> setHtml();  
				$reg_error = $mail -> sendMail();  
			}           
			
			if(!$reg_error) 
			{				
				$info_in = 'На почтовый адрес <b>'. $_POST['email'] .'</b> отправлен код регистрации';
				
				$_POST['new_num'] = 1;
				//$data['contentIn'] = "#forgot-password-modal-content";
				//$data['contentIn'] = $for_contentIn['activate'];
				$data['contentIn'] = '#code-modal-content';
				//reDirect('reg=activate', 'id=0', 'num=1'); '#code-modal-content'
			}
			else  
			$reg_error = 'Что то поломалось!'; 
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
	require '../../_inc_menu.php';
	require './_controller_ajax_bottom.php';
	
?>