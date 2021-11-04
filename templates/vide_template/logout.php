<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   unset($_SESSION["locked"]);
   unset($_SESSION["login_attempts"]);
   
   echo 'You have cleaned session';
   header('Refresh: 2; URL = login.php');
?>