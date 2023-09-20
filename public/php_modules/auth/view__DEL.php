<?php

/**
* View of the module of registration
* Отображение модуля регистрации
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
///////////////////////////////////////////////////////////

    $POST      = htmlChars($POST);
    $GET['id'] = !empty($GET['id'])?htmlChars($GET['id']):'';
/** 
* The switch of templates
* Переключатель шаблонов
*/

//dbg($GET['reg']);

    switch($GET['reg'] && !isset($_SESSION['user_data']))
    {
        case 'login':
				$style_display = '#signup-modal-content, #forgot-password-modal-content, #code-modal-content, #password-modal-content, #user-modal-content'; // для <style... display: none
         break;
		
        case 'registration':
			 	$style_display = '#login-modal-content, #forgot-password-modal-content, #code-modal-content, #password-modal-content, #user-modal-content';
        break;
        
        case 'restoration':
			 	$style_display = '#login-modal-content, #signup-modal-content, #code-modal-content, #password-modal-content, #user-modal-content';
        break;

        case 'activate':
			 	$style_display = '#login-modal-content, #signup-modal-content, #forgot-password-modal-content, #password-modal-content, #user-modal-content';
        break;
		
        case 'new_pw':
			 	$style_display = '#login-modal-content, #signup-modal-content, #forgot-password-modal-content, #code-modal-content, #user-modal-content';
        break;
                       
        case 'user':
			 	$style_display = '#login-modal-content, #signup-modal-content, #forgot-password-modal-content, #code-modal-content, #password-modal-content';
        break;

        default:
				$style_display = '#login-modal-content, #signup-modal-content, #forgot-password-modal-content, #code-modal-content, #password-modal-content, #user-modal-content'; 		
    }
	
	//require_once './skins/tpl/register/form_modal_register.tpl';
	