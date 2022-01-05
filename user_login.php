<?php session_start(); unset($_SESSION['user']); $_SESSION['logged'] = false; session_unset(); session_destroy();?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel="stylesheet" href="css/hamburger.css">
      <link rel = "icon" href = "img/site-icon.webp" type = "image/x-icon">
      <title>☕ User Login 🍵</title>
   </head>
   <body>
     <?php include 'includes/hamburger.php' ?>
      <header class="showcase">
         <div class="showcase-inner">
            <h1>☕ User Login 👤</h1>
            <form action=user_signin.php method="POST">
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