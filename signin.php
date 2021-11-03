<?php session_start(); isset($_SESSION['attempts'])?$_SESSION['attempts']:'';?>
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
               <li><a href="faq.php">FAQ</a></li>
               <li><a href="contact.php">Contact Us</a></li>
             <li><a href="menu.php">Product Menu</a></li>
             </ul>
           </div>
         </div>
       </div>
     </div>


      <div class="showcase">
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
               $_SESSION['attempts'] = 0;
               $_SESSION['logged'] = true;
               $_SESSION['user'] = $username;

           }
           else
           {
               echo '<h2>The username or password are incorrect!</h2>';
               $_SESSION['attempts']++;
               echo '<h4>Login Attempts: ';
               echo $_SESSION['attempts'];
               echo '</h4>';
           }

         }

         else {

           if(isset($_SESSION['timeout'])) {
             echo '<h2>log-in attempts are currently not allowed</h2>';
             if ($_SESSION['timeout'] + 10 < time()) {
               header("Refresh:0");
               $_SESSION['attempts'] = 0;
               session_unset();     // unset $_SESSION variable for the run-time
               session_destroy();   // destroy session data in storage
             }
           }

           else {
             echo '<h2>you are not allowed to log-in for 10 seconds 😝</h2>';
             $_SESSION['timeout'] = time();
           }

           // echo $_SESSION['timeout'] + 10 - time();   // Uncomment for debugging

           }


         $conn->close();

         // mysql_query($conn, $sql);
         // header("Location: ../index.php?signup=success");

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
