<?php
   $dbServername = ;
   $dbUsername = ;
   $dbPassword = ;


   // Initialize Connection
   $conn = new mysqli($dbServername, $dbUsername, $dbPassword);

   // Check connection
   if ($conn->connect_error) {
     die("Database Connection Inactive: " . $conn->connect_error);
   }
   // echo "<br> <br> Database Connection Active <br> <br>";
   ?>
