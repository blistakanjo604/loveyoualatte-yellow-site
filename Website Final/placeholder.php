<?php
session_start();
if ($_SESSION['logged'] != true) {
  	header("Location: login.php");
     exit();
  }
?>

<!DOCTYPE html>
<html lang=en>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel="stylesheet" href="style.css">
      <link rel = "icon" href = "img/site-icon.webp" type = "image/x-icon">
      <title>☕ Love You A Latte 🍵</title>
      <meta name="description" content="Hello World! Only a simple coffee site (but respects your dark mode setting and has responsive web design). No ads, no tracking, nothing but basic coffee and good service.">
   </head>
   <body>
      <div class=banner>
         <h1 class=forte>☕ Love You A Latte 🍵</h1>
         <hr/>
      </div>
      <p class="centered">Hello World! Only a simple coffee site (but respects your dark mode setting and has responsive web design). No ads, no tracking, nothing but basic coffee and good service.</p>
      <hr>
      <div class="centered">
         <h2>
            <a href="index.php">home</a>
            <a href="contact.php">contact</a>
            <a href="faq.php">faq</a>
            <a href="menu.php">menu</a>
         </h2>
         <hr>
         <br><br>
         <h1>This is a placeholder for the Add Menu Item and Update Menu Item Page</h1>
         <h2>Feel free to look at this hidden design</h2>
      </div>
      <br><br><br>
      <footer>
         <hr/>
         <a href="index.php">home</a>
         <a href="contact.php">contact</a>
         <a href="faq.php">faq</a>
         <a href="menu.php">menu</a>
         <br>
         <p>All site content is in the Public Domain.</p>
         <p><small>Powered by <a href="https://github.com/blistakanjo604">github/blistakanjo604</a></small></p>
         <?php
         if($_SESSION['logged']==true)
           {
             echo '<p><small>User Logged in: ';
             echo $_SESSION['user'];
             echo ' <a href="login.php">log-out?</a></small></p>';
           }
         elseif($_SESSION['logged']==false)
           {
             echo '<p><small>are you an employee? <a href="login.php">log-in!</a></small></p>';
           }
         ?>
      </footer>
   </body>
</html>
