<?php
	require_once '_inc_first.php';
	
	/* Заменяем $ok т.к. в variables.php: $ok = !empty($_POST['ok'])?true:false; , 
	а в Ajax и "<button name="ok"...":	$_POST['ok'] не передается */
	$ok = !empty($_POST)?true:false; 

////////////////////////////////////////////////////////////////////

/**
* Authorisation (exit)
* Аутентификация (выход)
* @author IT studio IRBIS-team
* @copyright © 2009 IRBIS-team
*/

/////////////////////////////////////////////////////////

/**
* Generation of page of an error at access out of system
* Генерация страницы ошибки при доступе вне системы
*/
    /*if(!defined('BBR_KEY'))
    {
       header("HTTP/1.1 404 Not Found");      
       exit(file_get_contents('404.html'));
    }*/ 
//////////////////////////////////////////////////////////

//dbg($_SESSION['user_data']);


	//session_start();

	
	
	
	//echo json_encode($data);
////////////////////////////////////////////////////////////////////
/*
"#login-modal-content"
"#signup-modal-content"
"#forgot-password-modal-content"
"#code-modal-content"
"#password-modal-content"
"#user-modal-content"
*/
	
	
   	unset($_SESSION['user_data']);  
    session_destroy();  
    setcookie('hash', '', time() - 3600 * 24, "/"); 
	
	

// require '_inc_menu.php';
require './_inc_end_echo.php';

?>