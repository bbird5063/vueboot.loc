<?php
	require 'require_ajax.php';
	
	/* Заменяем $ok т.к. в variables.php: $ok = !empty($_POST['ok'])?true:false; , 
	а в Ajax и "<button name="ok"...":	$_POST['ok'] не передается */
	$ok = !empty($_POST)?true:false; 

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
    //include_once './libs/mysql.php'; 
	require 'libs/mysql.php';   
    
/**   
* Check of the entered data   
* Проверка введенных данных  
*/         

    if($ok)  
    {  
        if(!$POST['password'] || !$POST['password2'])  
            $reg_info[] = 'Введите пароль!'; 
        elseif(mb_strlen($POST['password']) < 8)  
            $reg_info[] = 'Пароли должны содержать не менее восьми символов!';   
        elseif($POST['password'] !== $POST['password2'])  
            $reg_info[] = 'Пароли не совпадают!';  

/**   
* Registration of the new user   
* Регистрация нового пользователя   
*/
        if(!count($reg_info))  
        { 
             
            //include_once './modules/register/functions.php';  
            require './functions.php';            
            mysqlQuery("UPDATE `". BBR_DBPREFIX ."user`    
                        SET  `password` = '". md5($POST['password'] . BBR_SALT) ."'   
                        WHERE `id` = '". $_SESSION['user_data']['id'] ."'   
                       ") ;             
			
			$POST['new_num'] = 0;
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
require '_inc_menu.php';
require './_controller_ajax_bottom.php';

?>