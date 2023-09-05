<?php 
/**  
* Подключение нужных файлов для Ajax-контроллеров
*/ 
///////////////////////////////////////////////////////// 

	//session_start();  

/**  
* Debug  
* Дебаггер 
* @TODO To clean in release 
*/ 
   	//define('BBR_TRACE', true);    
   	//require 'debug.php'; 
  
 /** 
* Installation of a key of access to files 
* Установка ключа доступа к файлам 
*/ 
   	//define('BBR_KEY', true); 
/** 
* We connect a configuration file 
* Подключаем конфигурационный файл 
*/ 
    require 'config.php';  

/** 
* We connect a file of the language 
* Подключаем языковой файл 
*/ 
    //require 'language/'. BBR_LANGUAGE .'.php';  

/** 
* We connect a file of the general functions 
* Подключаем файл общих функций 
*/   
    //require 'libs/default.php'; 

/** 
* Получаем файл переменных  
* Receive a variables file  
*/ 
    //require 'variables.php'; 
    
/** 
* We connect a file of the views functions 
* Подключаем файл функций отображения
*/   
    //require 'libs/view.php';
	