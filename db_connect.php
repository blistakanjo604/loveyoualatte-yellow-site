<?php

$dbServername = "localhost";
$dbUsername = "yellow";
$dbPassword = "YellowTA@m-!02Server";


// Initialize Connection
$conn = new mysqli($dbServername, $dbUsername, $dbPassword);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br> <br>";
?>
