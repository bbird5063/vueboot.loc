<?php
	require '_inc_first.php';
	
	/* Заменяем $ok т.к. в variables.php: $ok = !empty($_POST['ok'])?true:false; , 
	а в Ajax и "<button name="ok"...":	$_POST['ok'] не передается */
	$ok = !empty($_POST)?true:false; 

////////////////////////////////////////////////////////////////////


/** 
* Восстановление пароля
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
   //include_once './mysql.php';  
   require 'mysql.php';  
    
/**   
* Check of the entered data   
* Проверка введенных данных  
*/         

    if($ok)  
    {  
		if($_POST['new_num'] != 3) { // не "восстановление пароля"
        	if(!$_POST['login'])  
            	$reg_info[] = 'Вы не ввели логин.';  
  
        	if(!$_POST['email'])  
            	$reg_info[] = 'Для восстановления пароля нужен почтовый адрес.';  
        	elseif(!preg_match("/^[a-z0-9_.-]+@([a-z0-9]+.)+[a-z]{2,6}$/i", $_POST['email']))  
            	$reg_info[] = 'Неверный формат e-mail.'; 
		}			
    }
	

	if($ok && !count($reg_info))
	{             

		$login = ($_POST['new_num']==3)?($_SESSION['user_data']['login']):(escapeString($_POST['login']));
		$email = ($_POST['new_num']==3)?($_SESSION['user_data']['email']):(escapeString($_POST['email']));
		
        $res = mysqlQuery("SELECT *   
                            FROM `". BBR_DBPREFIX ."user`   
                            WHERE `login` = '". $login ."' AND `email` = '". $email ."'"); 
                             
                     
        if(mysqli_num_rows($res) > 0)      
        {
			$row = mysqli_fetch_assoc($res);
			$_SESSION['email'] = $row['email'];
		}  
		else		 
             $reg_info[] = 'Логин или Email заданы неверно!';

/**   
* Registration of the new user   
* Регистрация нового пользователя   
*/          
        if(!count($reg_info)) 
        {  
            //include_once './modules/register/functions.php';
			require './functions.php';            
            
            $row[] = mysqli_fetch_assoc($res);  
            $hash = md5(randStr() . $row['id']);

            mysqlQuery("UPDATE `". BBR_DBPREFIX ."user`   
                        SET  `hash` = '". $hash ."'  
                        WHERE `id` = '". $row['id'] ."'  
                       ") ;      
      
            $subject = ($_POST['new_num'] == 3?"Изменение пароля":"Восстановление доступа");      
            $message = "С Вашего электронного почтового адреса поступила заявка на восстановление  
                        доступа к аккаунту на сайте <b>". $_SERVER['HTTP_HOST'] ."</b><br>\n     
                        Для доступа в аккаунт пройдите по 
                        <a href=\"". href("reg=activate", "id=$hash", "num=2") ."\" >этой ссылке</a><br />
                        и введите в поле активации этот код: <b>". $hash ."</b>";                         
 			//$_POST['new_num'] = 2;
			
            if(BBR_DBSERVER == 'localhost')
				file_put_contents('' . $subject . '.html', $message);
			else
			{
				//include_once './libs/bbr_mailer.php'; 
				require 'libs/bbr_mailer.php';				
            	$mail = new BBR_Mailer($message); 
   
            	$mail -> createTo($row['email']);  
            	$mail -> createSubject($subject);  
            	$mail -> createFrom(BBR_SUPPORT_EMAIL, BBR_SUPPORT_EMAIL); 
            	$mail -> setHtml();  
            	$reg_error = $mail -> sendMail();  
            }            

            if(!$reg_error) 
			{				
                $info_in = 'На почтовый адрес <b>'. $row['email'] .'</b> отправлен код восстановления';
				
				//$_POST['new_num'] = 2;
				//$data['contentIn'] = "#code-modal-content";
				//$data['contentIn'] = $for_contentIn['activate'];
				$data['contentIn'] = '#code-modal-content';
				//reDirect('reg=activate', 'id=0', 'num=2'); '#code-modal-content'
			}
            else  
                $reg_info_page[] = 'Что то поломалось'; 
        }  
   }
   elseif(!empty($_SESSION['login'])) /* регистрироваля пользователь, логин которового был в базе, но он не был активирован.  */
   {
		//dbg($_SESSION['login'], true); // не наступит - наступил: регистрация логина, который есть в базе, в модальном называем "Активировать" 
		$_POST['login'] = $_SESSION['login'];	
		$_POST['email'] = $_SESSION['email'];	
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
require './_inc_end_echo.php';

?>