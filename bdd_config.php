<?php
  // URL of the host
  $dbhost = "localhost";

  // Name of the database
  $dbname = "vote";

  // User name
  $dbuser = "root";

  // Password (not used here)
  $dbpass = "password";

  try {
    $connection = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>
