<?php
// public
if(isset($_POST['test'])) 
  $data['info'] = ' Все Ok (POST) -> ' . $_POST['test'];
elseif(isset($_GET['test'])) 
  $data['info'] = ' Все Ok (GET) -> ' . $_GET['test'];
else
  $data['info'] = 'Не получили $_POST($_GET)[test]';

echo json_encode($data);
?>