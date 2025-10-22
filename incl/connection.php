<?php
$servername = "0.0.0.0";
$username = "root";
$password = "root";
$dbName = "geometryjump";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  exit("-1");
  //echo "Connection failed: " . $e->getMessage();
}
?>
