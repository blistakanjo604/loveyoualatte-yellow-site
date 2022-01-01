<?php session_start(); isset($_SESSION['attempts'])?$_SESSION['attempts']:'';?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel="stylesheet" href="css/hamburger.css">
      <link rel = "icon" href = "img/site-icon.webp" type = "image/x-icon">
      <title>☕ Log-in 🍵</title>
   </head>
   <body>
     <?php include 'includes/hamburger.php' ?>
      <header class="showcase">
         <div class="showcase-inner">
            <h1>☕ Employee Login 👤</h1>
            <form action=employee_signin.php method="POST">
               <label for="username">Username</label>
               <input type="text" id="username" name="username"> <br>
               <label for="password">Password</label>
               <input type="password" id="password" name="password"> <br>
               <!--input type="Submit" name="submit" id="sub"-->
               <button type="submit" name="submit">Log-in</button>
            </form>
            <?php
               session_start();
               include_once 'includes/init_connect.php';

               $username = $_POST['username'];
               $password = $_POST['password'];

               $statement = $conn->prepare("SELECT * FROM testing.kyle_accounts WHERE username = ?");
               $statement->bind_param("s", $username);
               $statement->execute();
               $findUser = $statement->get_result()->fetch_assoc();


               if ($_SESSION['attempts'] < 2) // Less than 2 because it starts the count from 0
               {
                 if ($findUser && password_verify($password, $findUser['password']))
                 {
                     echo '<br>The username and password are correct 🤗<br>';
                     echo '<br>Redirecting you to Homepage in 3 seconds… ⏲<br>';
                     $_SESSION['attempts'] = 0;
                     $_SESSION['logged'] = true;
                     $_SESSION['user'] = $username;
                     $_SESSION['account'] = 'employee';
                     header("Refresh:3; url=index.php");

                 }
                 else
                 {
                     echo '<br><h2>The username or password are incorrect!</h2>';
                     $_SESSION['attempts']++;
                     echo '<h4>Login Attempts: ';
                     echo $_SESSION['attempts'];
                     echo '</h4>';
                 }

               }

               else {

                 if(isset($_SESSION['timeout'])) {
                   echo '<br><h2>log-in attempts are currently not allowed</h2>';
                   if ($_SESSION['timeout'] + 900 < time()) {
                     header("Refresh:0");
                     $_SESSION['attempts'] = 0;
                     session_unset();     // unset $_SESSION variable for the run-time
                     session_destroy();   // destroy session data in storage
                   }
                 }

                 else {
                   echo '<br><h2>Account is now locked. Please try again later. 😝</h2>';
                   $_SESSION['timeout'] = time();
                 }

                 // echo $_SESSION['timeout'] + 10 - time();   // Uncomment for debugging

                 }


               $conn->close();

               // mysql_query($conn, $sql);
               // header("Location: ../index.php?signup=success");

               ?>
         </div>
      </header>
   </body>
</html>
