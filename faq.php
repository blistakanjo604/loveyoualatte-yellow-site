<?php
   session_start();
   ?>
<!DOCTYPE html>
<html lang="en">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <head>
      <title>☕ FAQ 🍵</title>
      <script src="https://use.typekit.net/axs3axn.js"></script>
      <script>try{Typekit.load({ async: true });}catch(e){}</script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
      <!--link rel="stylesheet" type="text/css" href="css/main2.css"-->
      <link rel = "icon" href = "img/site-icon.webp" type = "image/x-icon">
      <link rel="stylesheet" href="css/hamburger.css">
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
      <header class="showcase">
         <div class="container showcase-inner">
            <h1>📑 FAQ 📖</h1>
            <ul class="no">
               <li>
                  <h4>Hours</h4>
               </li>
               <li>MONDAY 5am - 10 p.m.</li>
               <li>TUESDAY 5am - 10 p.m.</li>
               <li>WEDNESDAY 5am - 10 p.m.</li>
               <li>THURSDAY 5am - 10 p.m.</li>
               <li>FRIDAY 5am - 10 p.m.</li>
               <li>SATURDAY 5am - 10 p.m.</li>
               <li>SUNDAY 3pm - 8 p.m.</li>
               <br>
               <li>
                  <h4>Story about why the owner created the first Love You A Latte store:</h4>
               </li>
               <br>
               <li>I have been a coffee enthusiast my whole life and am passionate about the art of making it. After having worked at various coffee shops over the years, I finally decided to open my own shop. My goal was to create good tasting coffee with fresh ingredients to provide the superior cup of coffee. I also wanted to create a local spot that people could enjoy and socialize and still feel like they were at home. This led to me opening the first Love You A Latte shop. Since opening, we have been able to deliver the best customer service, a comfortable environment, and most importantly, the best tasting coffee.</li>
               <br>
               <li>
                  <h4>Suppliers:</h4>
               </li>
               <br>
               <li>Apollo Farms</li>
               <li>Beneficio Farms</li>
               <li>BRC Vending and Coffee Services</li>
               <li>Fazenda Express</li>
               <li>BC Restaurant Equipment</li>
            </ul>
         </div>
      </header>
   </body>
</html>
