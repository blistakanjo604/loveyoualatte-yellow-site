<!DOCTYPE html>
<html lang=en>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
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


      <form  action="retrieve.php" method="POST">
              <!--a type="submit" class="btn"> 🥚 THE BUTTON 🥚 </a--> <!-- Let's try to make the fancy button work soon -->
      <button type="submit" name="submit">🥚 THE BUTTON 🥚</button>
    </form>

    <?php
// Dirty code just to get things working…
include_once 'db_connect.php';

?>


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
          <p><small>are you an employee? <a href="login.php">log-in!</a></small></p>
      </footer>

</body></html>
