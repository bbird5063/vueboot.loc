<?php
require_once '_inc_first.php';

/* Заменяем $ok т.к. в variables.php: $ok = !empty($POST['ok'])?true:false; , 
	а в Ajax и "<button name="ok"...":	$POST['ok'] не передается */
$ok = !empty($POST) ? true : false;

////////////////////////////////////////////////////////////////////

/**
 * Authorisation (the controller)
 * Аутентификация (контроллер)
 * @author IT studio IRBIS-team
 * @copyright © 2009 IRBIS-team
 */
/////////////////////////////////////////////////////////

/**
 * Generation of page of an error at access out of system
 * Генерация страницы ошибки при доступе вне системы
 */
if (!defined('BBR_KEY')) {
	header("HTTP/1.1 404 Not Found");
	exit(file_get_contents('404.html'));
}

//////////////////////////////////////////////////////////

/**
 * We connect a file of the MySQL functions
 * Подключаем файл функций MySQL
 */
//include_once './mysql.php'; 
require_once 'mysql.php';


/**   
 * Check of the entered data   
 * Проверка введенных данных  
 */
if ($ok) {
	if (!$POST['login'])
		$reg_info[] = 'Вы не ввели логин.';

	elseif (!$POST['password'])
		$reg_info[] = 'Введите пароль!';
}

/**  
 * Authorisation of the user
 * Аутентификация пользователя 
 */
if (!$ok && isset($_COOKIE['hash'])) /* Первая загрузка сайта (!$ok): никто ничего не вводил, но есть $_COOKIE['hash'] (т.е. когда-то при правильном входе пользователь поставил причку "запомнить") Тогда воодим данные юзера в $_SESSION['user_data'] */ {
	//include_once './modules/register/functions.php';
	//require_once 'modules/register/functions.php';
	require_once './functions.php';

	$_SESSION['user_data'] = getLogin($_COOKIE['hash'], true); /* находим в таблице user запись с $_COOKIE['hash'] и присваиваем ее $_SESSION['user_data'] */
} elseif ($ok && !count($reg_info)) /* !isset($_COOKIE['hash']) когда-то при правильном входе пользователь не поставил причку "запомнить" */ {
	$res = mysqlQuery("SELECT *   
                           FROM `" . BBR_DBPREFIX . "user`  
                           WHERE `login`    = '" . escapeString($POST['login']) . "'");

	if (mysqli_num_rows($res) > 0) {
		mysqli_data_seek($res, 0); // Перемещает указатель результата на выбранную (0) строку
		//$row = mysqli_fetch_array($res);
		$row = mysqli_fetch_array($res, MYSQLI_ASSOC);  // получаем массив из 1 строки таблицы

		if ($row['password'] == md5($POST['password'] . BBR_SALT) && !empty($row['activate'])) {
			/* в случае наличия в таблице user записи login, password, activate: присваиваем данные пользователя в $_SESSION['user_data'] */
			/*$_SESSION['user_data'] = mysqli_fetch_assoc($res);*/
			$_SESSION['user_data'] = $row;

			if ($POST['remember']) /* юзер поставил причку "запомнить" */ {
				//include_once './modules/register/functions.php';
				//require_once 'modules/register/functions.php';
				require_once './functions.php';
				setAutologin($_SESSION['user_data']['id']); /* устанавливаем setcookie('hash'...) и в записи user ставим hash 
					Предупреждение: попытка доступа к смещению массива для значения типа null в C:xampphtdocsirbis_guest_boot_ajax.bbrwwwmodulesregisterread_controller.php в строке 60
					*/
			}
		} elseif (empty($row['activate']) && !empty($row['email'])) {
			$data['new_num'] = 1;
			$data['contentIn'] = '#forgot-password-modal-content';


			$reg_info[] = "Aккаунт <b>" . $row['login'] . "</b> не активирован!
				<br>Для активизации заполнить поля:<br><br>
				<br><br>";
			$_SESSION['login'] = $row['login'];
			$_SESSION['email'] = $row['email'];
		} else // не совпадает пароль
		{
			$reg_info[] = 'Пароль не совпадает!';
		}
	} else
		$reg_info[] = 'Пользователя с логином <b>' . $POST['login'] . '</b> нет в нашей базе!';
}
if (isset($_SESSION['user_data'])) {
	$reg_info_page[] = "Здорово, <b>" . $_SESSION['user_data']['login'] . "</b>! Где шлялся?";
	//reDirect('page=guest', 'rem=read');
} else
	$reg_info_page[] = 'Введите логин и пароль:';

/*		
===================================================================
ИТОГИ:
$_COOKIE используется, если пользователь поставил причку "запомнить", это $_COOKIE['hash'], который есть и в поле 'hash' таблицы 'user'.

$_SESSION['user_data'] используется в обеих случаях.
Данные пользователя находят в таблице 'user':
1. по hash = $_COOKIE['hash']
2. по login AND password, введенных в поля формы (еще уставливаются $_COOKIE['hash'] и user.hash)
Потом присваюватся $_SESSION['user_data'].
*/

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
