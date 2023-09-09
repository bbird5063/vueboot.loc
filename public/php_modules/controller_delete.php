<?php 
  $data = [];

  require_once 'config.php';
    
  $conn = new mysqli(BBR_DBSERVER, BBR_DBUSER, BBR_DBPASSWORD, BBR_DATABASE);
  if ($conn->connect_error) die($conn->connect_error);
  $id = $conn->real_escape_string($_GET['id']);
  $query = "DELETE FROM posts WHERE id = $id";
  $result = $conn->query($query);
  if (!$result) die($conn->error);
  $data['result'] = $result;

  $query  = 'SELECT COUNT(*) AS count FROM posts';
  $result = $conn->query($query);
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $data['cnt_rows'] = $row['count'];
  $result->close();

  $conn->close();
  echo json_encode($data);
  ?>