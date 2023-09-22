<?php 

    if(!isset($_SESSION['user_data'])) {
		$link_registr = '
			<li id="enterModal" for="enter"><a href="javascript:void(0)">' . 'Вход' . '&nbsp;&nbsp;' . '<i class="glyphicon glyphicon-log-in"></i></a>
			</li>';
	}
    else {
		$link_registr = '
          	<li id="enterModal" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">' . '&nbsp;' . '<i class="glyphicon glyphicon-user"></i>' . '&nbsp;&nbsp;&nbsp;' . $_SESSION['user_data']['login'] . '&nbsp;&nbsp;&nbsp;' . '<b class="caret"></b></a>
            	<ul class="dropdown-menu">
              		<li><a id="menuProfile" href="javascript:void(0)">Профиль</a></li>
              		<li><a id="menuChangePW" href="javascript:void(0)">Изменить пароль</a></li>
              		<li><a id="menuMail" href="javascript:void(0)"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
              		<li class="divider"></li>
              		<li><a id="menuExit" href="javascript:void(0)"><b>Выход</b>' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . '<i class="glyphicon glyphicon-log-out"></i></a></li>
            	</ul>
		  	</li>
		';
		
	}		


//javascript:void(0)
//' . href('reg=exit') . '

    /*if(!isset($_SESSION['user_data'])) {
		$add_active = $GET['page']=='register'?' class="active"':'';
        
		$link_registr = '<li' . $add_active . '><a href="'.href('reg=login') .'">' . 'Вход' . '&nbsp;&nbsp;' . '<i class="glyphicon glyphicon-log-in"></i></a></li>';
	}
    else {
		$add_active = $GET['page']=='register'?' active':'';
	
		$link_registr = '
          <li class="dropdown' . $add_active . '"><a class="dropdown-toggle" data-toggle="dropdown" href="' . href('reg=exit') . '">' . '&nbsp;' . '<i class="glyphicon glyphicon-user"></i>' . '&nbsp;&nbsp;&nbsp;' . $_SESSION['user_data']['login'] . '&nbsp;&nbsp;&nbsp;' . '<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="' . href('reg=user','id=0','num=3') . '">Профиль</a></li>
              <li><a href="' . href('reg=restoration','id=0','num=3') . '">Изменить пароль</a></li>
              <li><a id="menuMail" href="javascript:void(0)"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
              <li class="divider"></li>
              <li><a href="' . href('reg=register', 'rem=exit') . '"><b>Выход</b>' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . '<i class="glyphicon glyphicon-log-out"></i></a></li>
            </ul>
		  </li>
		';
		
	}*/		


//require './_inc_menu.php';
//// require '_inc_menu.php';