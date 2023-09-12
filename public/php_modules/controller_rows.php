<?php 
  $data = [];
  $params = [];
  
  if(isset($_GET)) $params = $_GET;

  require_once 'config.php';
    
  $conn = new mysqli(BBR_DBSERVER, BBR_DBUSER, BBR_DBPASSWORD, BBR_DATABASE);

  if ($conn->connect_error) die($conn->connect_error);
  $limit = isset($_GET['limit']) ? ' LIMIT ' . ($conn->real_escape_string($_GET['limit'])) : '';
  $offset = isset($_GET['offset']) ? ' OFFSET ' . ($conn->real_escape_string($_GET['offset'])) : '';
  
  $query  = 'SELECT * FROM posts' . $limit . $offset;
  $result = $conn->query($query);

  if (!$result) die($conn->error);

  $cnt_rows = $result->num_rows;
  if($cnt_rows > 0) {
    for ($j = 0 ; $j < $cnt_rows ; ++$j) {
      $row = [];
      $result->data_seek($j);
      $row = $result->fetch_array(MYSQLI_ASSOC);
      $data['rows'][] = $row;
    }
  }
  $result->close();

  $query  = 'SELECT COUNT(*) AS count FROM posts';
  $result = $conn->query($query);
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $data['cnt_rows'] = $row['count'];
  $result->close();

  $conn->close();
  echo json_encode($data);
  ?>