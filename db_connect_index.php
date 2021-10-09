<?php

$dbServername = "localhost";
$dbUsername = "yellow";
$dbPassword = "YellowTA@m-!02Server";


// Initialize Connection
$conn = new mysqli($dbServername, $dbUsername, $dbPassword);

// Check connection
if ($conn->connect_error) {
  die("Database Connection Inactive: " . $conn->connect_error);
}
echo "<br> <br> Database Connection Active <br> <br>";

$query = "SELECT time FROM loveyoualatte.customer ORDER BY time DESC  LIMIT 1;";


$result = $conn->query($query);

/* fetch associative array */
echo "The last time 🥚 THE BUTTON 🥚 was pressed was on: <br><br>";

while ($row = $result->fetch_assoc()) {
    echo $row["time"];
}

$conn->close();

?>
