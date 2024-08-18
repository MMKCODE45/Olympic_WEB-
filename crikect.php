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
  
  $sql = "SELECT * FROM crikect";
  $result = $conn->query($sql);
  
  $matches = array();
  while($row = $result->fetch_assoc()) {
      $matches[] = $row;
  }
  
  echo json_encode($matches);
  
  $conn->close();
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>World cup 2022</title>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="football.css" />
  </head>

  <body>
    <div class="container">
      <div class="match-tabs">
        <li class="tab-link">
          <a href="#match-date">Match By Date</a>
        </li>
        <li class="tab-link">
          <a href="#match-group">Match By Group</a>
        </li>
      </div>
      <h1 class="section-heading">Match By Date</h1>
      <div class="matchs" id="match-date"></div>
      <h1 class="section-heading">Match By Group</h1>
      <div class="matchs-by-group" id="match-group"></div>
    </div>
    <div class="scroll-top">
      <img src="arrow.png" alt="arrow" />
    </div>
    <script src="football.js"></script>
    <script>
        
    </script>
    
  </body>
</html>
