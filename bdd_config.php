<?php
  // URL of the host
  $dbhost = "mysql-gp6-web.alwaysdata.net";

  // Name of the database
  $dbname = "gp6-web_elections";

  // User name
  $dbuser = "gp6-web";

  // Password (not used here)
  $dbpass = "49VXe3gUSW3PyES";

  try {
    $connection = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpass);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>
