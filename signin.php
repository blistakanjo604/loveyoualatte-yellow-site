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
      <div class="menu-wrap">
         <input type="checkbox" class="toggler">
         <div class="hamburger">
            <div></div>
         </div>
         <div class="menu">
            <div>
               <div>
                  <ul>
                     <!-- add pages/ once we clean up the sites directory  -->
                     <li><a href="index.php">Home</a></li>
                     <li><a href="faq.php">FAQ</a></li>
                     <li><a href="contact.php">Contact Us</a></li>
                     <li><a href="menu.php">Product Menu</a></li>
                     <?php
                        if($_SESSION['logged']==true)
                          {
                            echo '<li><a href="login.php">Log-out</a></li>';
                            echo '<small class="menu-small">User Logged in: ';
                            echo $_SESSION['user'];
                            echo ' ☕ </small>';
                          }
                        elseif($_SESSION['logged']==false)
                          {
                            echo '<li><a href="login.php">Log-in</a></p>';
                          }
                        ?>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <header class="showcase">
         <div class="showcase-inner">
            <h1>☕ L o g - i n 👤</h1>
            <form action=signin.php method="POST">
               <label for="username">Username</label>
               <input type="text" id="username" name="username"> <br>
               <label for="password">Password</label>
               <input type="password" id="password" name="password"> <br>
               <!--input type="Submit" name="submit" id="sub"-->
               <button type="submit" name="submit">Log-in</button>
            </form>
            <?php
               session_start();
               include_once 'init_connect.php';

               $username = $_POST['username'];
               $password = $_POST['password'];

               $result = $conn->query("SELECT * FROM loveyoualatte.employeelogin WHERE username = '$username' AND password = '$password';");



               if ($_SESSION['attempts'] < 2) // Less than 2 because it starts the count from 0
               {
                 if (mysqli_num_rows($result) > 0)
                 {
                     echo '<br>The username and password are correct 🤗<br>';
                     echo '<br>Redirecting you to Homepage in 3 seconds… ⏲<br>';
                     $_SESSION['attempts'] = 0;
                     $_SESSION['logged'] = true;
                     $_SESSION['user'] = $username;
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
                   echo '<br><h2>you are not allowed to log-in for 15 minutes 😝</h2>';
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
