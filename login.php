<?php session_start(); unset($_SESSION['user']); $_SESSION['logged'] = false; ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel="stylesheet" href="css/hamburger.css">
      <title>Love you A Latte (Yellow 02 Capstone)</title>
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
            <h1>Employee Login</h1>
            <form action=signin.php method="POST">
               <label for="username">Username</label>
               <input type="text" id="username" name="username"> <br>
               <label for="password">Password</label>
               <input type="password" id="password" name="password"> <br>
               <!--input type="Submit" name="submit" id="sub"-->
               <button type="submit" name="submit">Log-in</button>
            </form>
         </div>
      </header>
   </body>
</html>
