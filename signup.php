<?php
include_once 'db_connect.php';

$first = $_POST['first'];
$last = $_POST['last'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$sql = "INSERT INTO `loveyoualatte`.`customer` (`phone`, `first`, `last`, `email`) VALUES ('$phone', '$first', '$last', '$email');";

echo(date("Y-m-d H:i:s"));

if ($conn->query($sql) === true)
{
    echo "<br><br>New record created successfully";
}
else
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

//  mysql_query($conn, $sql);
//  header("Location: ../index.php?signup=success");

?>
