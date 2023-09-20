<?php

session_start();

define('BBR_TRACE', true);

require 'debug.php';

define('BBR_KEY', true);

require 'config.php';



/**
 * Information conclusion
 * Вывод информации        
 */
function getInfo($info, $sep = '<br>')
{
	if (count($info))
		//return $sep . implode($sep, $info);
		return implode($sep, $info);
	else
		return '&nbsp;';
}


// require 'default.php';

require 'variables.php';

//require 'view.php';
