<?php 
  $data = [];
  $params = [];
  
  if(isset($_POST)) $params = $_POST; // для отладки
  if(isset($_GET)) $params = $_GET;

  $data['params'] = $params; // для отладки

  require_once 'config.php';
    
  $connection = new mysqli(BBR_DBSERVER, BBR_DBUSER, BBR_DBPASSWORD, BBR_DATABASE);

  if ($connection->connect_error) die($connection->connect_error);

  $query  = 'SELECT * FROM posts' . (isset($params['limit']) ? (' LIMIT ' . $params['limit']) : '') . (isset($params['offset']) ? (' OFFSET ' . $params['offset']) : '');
  $data['params'] = $params; // для отладки
  //$data['params'] = $query; // для отладки
  $result = $connection->query($query);

  if (!$result) die($connection->error);

  $cnt_rows = $result->num_rows;

  for ($j = 0 ; $j < $cnt_rows ; ++$j) {
    $row = [];
    $result->data_seek($j);
	  $row = $result->fetch_array(MYSQLI_ASSOC);
    $data['rows'][] = $row;
  }

  $result->close();
  $connection->close();
  echo json_encode($data);