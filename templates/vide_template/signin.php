<!DOCTYPE html>
<html lang="en">
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
      <br>
      <div class="centered">
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
      <?php
         include_once 'init_connect.php';

         $_SESSION["count"] = 0;


         $username = $_POST['username'];
         $password = $_POST['password'];

         $result = $conn->query("SELECT * FROM loveyoualatte.employeelogin WHERE username = '$username' AND password = '$password';");

        /* if($_SESSION["count"] > 3)
         {
           echo '<h2>Exceeded Number of Log-in Attempts</h2>';

         }
         elseif (mysqli_num_rows($result) > 0 )
         {
             echo '<br>The username and password are correct 🤗<br>';
         }
         else
         {
             echo '<h2>The username or password are incorrect!</h2>';
             $_SESSION["count"] = $_SESSION["count"] + 1;
         } */

        if ($_SESSION["count"] > 3):
            echo '<h2>Exceeded Number of Log-in Attempts</h2>';
        elseif (mysqli_num_rows($result) > 0 ): // Note the combination of the words.
            echo '<br>The username and password are correct 🤗<br>';
        else:
          echo '<h2>The username or password are incorrect!</h2>';
          $_SESSION["count"] = $_SESSION["count"] + 1;
        endif;

         $conn->close();

         //  mysql_query($conn, $sql);
         //  header("Location: ../index.php?signup=success");

         ?>
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
   </body>
</html>
