<?php
	require 'require_ajax.php';
	
	/* Заменяем $ok т.к. в variables.php: $ok = !empty($_POST['ok'])?true:false; , 
	а в Ajax и "<button name="ok"...":	$_POST['ok'] не передается */
	$ok = !empty($_POST)?true:false; 

////////////////////////////////////////////////////////////////////

/**
* The controller of activation of the accounting record
* Контроллер активации учетной записи.
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
       exit(file_get_contents('404.html'));
    }    
//////////////////////////////////////////////////////////

/**
* We connect a file of the MySQL functions
* Подключаем файл функций MySQL
*/  
   	include_once 'libs/mysql.php';
	//require 'libs/mysql.php';
	
/**   
* Check of the entered data   
* Проверка введенных данных  
*/         
	
	if($ok && !empty($_POST['code']))
	{
		$sql = "SELECT *   
                FROM `". BBR_DBPREFIX ."user`   
                WHERE `hash` = '". escapeString($_POST['code']) ."'";  
        
		$result = mysqlQuery($sql);
		
		$cnt_rows =	mysqli_num_rows($result);
        if($cnt_rows==0) 
			$reg_error = 'Неправильный код!';
	}
	elseif($ok && empty($_POST['code']))
		$reg_error = 'Введите код!';
		
    if($ok && empty($reg_error)) // при "...&& !isset($reg_error)" не работало!!!
    { 
            include_once './functions.php';
			//require './functions.php';
			
            if($user_data = getLogin($_POST['code'], true)) /* getLogin - Функция автологина, которая по "user.hash = $_POST['code'] ("AND `activate` = 1" - это false по умолчанию )" получает записть $res */
            {
                
				//if($_POST['new_num'] == 1) // Активация в любом случае
					mysqlQuery("UPDATE `". BBR_DBPREFIX ."user`   
                            	SET  `activate` = 1  
                            	WHERE `id` = '". $user_data['id'] ."'  
                           		") ;    
                                   
                $_SESSION['user_data'] = $user_data;                
                
           		if($_POST['remember']) 
			/* 
			setAutologin: 
			получает аргумент user.id, 
			получает новый hash, 
			устанавливает новые cookie, 
			в таблице user меняем hash на новый. 
			В итого: 
			в $_SESSION['user_data'][hash] остается страрый hash, 
			а новый в cookie[hash] и user.hash 
			*/					
               		setAutologin($_SESSION['user_data']['id']);
                    
				/* Удаляем устаревшие записи */
           		$res = mysqli_query($_SESSION['db_connect'], "DELETE FROM `". BBR_DBPREFIX .				"user` 
                               WHERE `activate` != 1
                               AND `date` < NOW() - INTERVAL 10 DAY
                              ");                    
                if($_POST['new_num'] == 1) {
					$_POST['new_num'] = 0;
					//$data['contentIn'] = $for_contentIn[''];
					//reDirect('reg=off', 'num=0', 'id=0');
				}	
				elseif($_POST['new_num'] == 2) {
					$_POST['new_num'] = 0;
					//$data['contentIn'] = $for_contentIn['new_pw'];
					$data['contentIn'] = '#password-modal-content';
					//reDirect('reg=new_pw', 'num=0', 'id=0'); '#password-modal-content'
				}
				elseif($_POST['new_num'] == 3) {
					$_POST['new_num'] = 0;
					//$data['contentIn'] = $for_contentIn['new_pw'];
					$data['contentIn'] = '#password-modal-content';
					//reDirect('reg=new_pw', 'num=0', 'id=0'); '#password-modal-content'
				}
            }
            else {
                //$reg_info[] = BBR_LANG_INVLID_CODE;
				$reg_info[] = 'Error!!! - BBR_LANG_INVLID_CODE';
            }
    }
    
    $em = isset($_SESSION['email'])?$_SESSION['email']:'(Error: нет $_SESSION[email])';
    $reg_info_page[] = "На почтовый адрес <b>$em</b> отправлен код активации";

////////////////////////////////////////////////////////////////////
/*
"#login-modal-content"
"#signup-modal-content"
"#forgot-password-modal-content"
"#code-modal-content"
"#password-modal-content"
"#user-modal-content"
*/
require '_inc_menu.php';
require './_controller_ajax_bottom.php';

?>