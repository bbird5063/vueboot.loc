<?php 
  $data = [];

  require_once 'config.php';
    
  $conn = new mysqli(BBR_DBSERVER, BBR_DBUSER, BBR_DBPASSWORD, BBR_DATABASE);

  if ($conn->connect_error) die($conn->connect_error);
  
  $title = $conn->real_escape_string($_GET['title']);
  $body = $conn->real_escape_string($_GET['body']);

  $query = 'INSERT INTO posts (userId, title, body) VALUES (1, "'. $title .'", "' . $body . '")';
  $result = $conn->query($query);

  if (!$result) die($conn->error);

  $data['id'] = $conn->insert_id;

  $conn->close();
  echo json_encode($data);
  ?>