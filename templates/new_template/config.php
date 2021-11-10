<?php
// old template used: mysqli("localhost","root","","cart_system")
	$conn = new mysqli("localhost","yellow","YellowTA@m-!02Server","loveyoualatte");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>