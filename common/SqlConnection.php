<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oceangroup";


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn)
  {
  echo '<p> could not </p>';
  die('Could not connect: ' . mysql_error());
  }

?>
