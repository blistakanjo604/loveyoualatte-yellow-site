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
    <div class="hamburger"><div></div></div>
    <div class="menu">
      <div>
        <div>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="pages/FAQ.php">FAQ</a></li>
            <li><a href="ContactUs.php">Contact Us</a></li>
	        <li><a href="products.php">Product Menu</a></li>
            <li><a href="form.php">Sign-up (Old Website)</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <header class="showcase">
    <div class="container showcase-inner">
      <h1>Love you A Latte</h1>
      <p>Click our menu button in the upper left of the screen, and  select where you would like to go.</p>
      <a href="index.php" class="btn">Home</a><br><br>
      
      <!-- Testing out Database Time Retrieval -->
      
      <form  action="signup.php" method="POST">
                <!--a type="submit" class="btn"> 🥚 THE BUTTON 🥚 </a--> <!-- Let's try to make the fancy button work soon -->
				<button type="submit" name="submit">🥚 THE BUTTON 🥚</button>
				<p id="time"></p>
			</form>
			
			<?php 
                    // Dirty code just to get things working…
                    
                    include_once 'db_connect_index.php';

            ?>
    </div>
  </header>
</body>
</html>
