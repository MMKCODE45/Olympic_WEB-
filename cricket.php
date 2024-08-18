<?php
// Database connection settings
$host = 'localhost:3308'; // Change this if your database is hosted elsewhere
$dbname = 'funoly';
$username = 'root';
$password = 'Whales123';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "SELECT * FROM cricket";
  $result = $conn->query($sql);
  
  $matches = array();
  while($row = $result->fetch_assoc()) {
      $matches[] = $row;
  }
  
  echo json_encode($matches);
  
  $conn->close();
  ?>