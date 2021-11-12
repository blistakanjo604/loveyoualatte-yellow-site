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
      <link rel="stylesheet" href="css/hamburger.css">
      <link rel = "icon" href = "img/site-icon.webp" type = "image/x-icon">
      <title>☕ Love you A Latte 🍵</title>
   </head>
   <body>
     <?php include_once 'includes/hamburger.php' ?>
      <header class="showcase">
         <div class="container showcase-inner">
            <h1>☕ Love you A Latte 🍵</h1>
            <p>Click our menu button in the upper left of the screen, and  select where you would like to go.</p>
            <a href="index.php" class="btn">Home</a><br><br>
            <!-- Testing out Database Time Retrieval -->
            <form  action="retrieve.php" method="POST">
               <!--a type="submit" class="btn"> 🥚 THE BUTTON 🥚 </a--> <!-- Let's try to make the fancy button work soon -->
               <button type="submit" name="submit">🥚 THE BUTTON 🥚</button>
               <p id="time"></p>
            </form>
            <?php
               // Dirty code just to get things working…

               include_once 'includes/db_connect.php';


               ?>
         </div>
      </header>
   </body>
</html>
