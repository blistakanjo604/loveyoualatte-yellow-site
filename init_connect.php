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
   // echo "<br> <br> Database Connection Active <br> <br>";
   ?>
