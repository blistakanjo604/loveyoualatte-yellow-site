<?php
   session_start();
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel = "icon" href = "img/site-icon.webp" type = "image/x-icon">
      <link rel="stylesheet" href="css/hamburger.css">
      <title>☕ Contact Us 🍵</title>
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
         <div class="container showcase-inner">
            <h1>📞 Contact Us 📲</h1>
            <ul class="no">
               <li>Primary Address</li>
               <li>4401 Livingston Avenue, OH</li>
               <li>Phone: 614-008-5721</li>
               <li>Email</li>
               <a href = "mailto: yellowteam@loveyoualatte.com">
                  yellowteam@loveyoualatte.com</a
            </ul>
            <h2>Got a question? We’d love to hear from you.</h2>
            <a href="index.php" class="btn">Home</a><br><br>
         </div>
      </header>
   </body>
</html>
