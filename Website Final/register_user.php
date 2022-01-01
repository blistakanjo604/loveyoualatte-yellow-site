<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel="stylesheet" href="css/hamburger.css">
      <link rel = "icon" href = "img/site-icon.webp" type = "image/x-icon">
      <title>🚪 Signup 👤</title>
   </head>
   <body>
     <?php include 'includes/hamburger.php' ?>
      <header class="showcase">
         <div class="showcase-inner">
            <h1>🚪 Signup 👤</h1>
            <form action=user_register_commit.php method="POST">
              <table>
              <th>
              <tr> </tr>
              <tr> </tr>
              </th>
              <tr>
                <td align="left">Please enter your desired username: &nbsp; &nbsp;</td>
                <td><input type="text" id="username" name="username" placeholder="johnsmith"></td>
              </tr>
              <tr>
                <td align="left">Please enter your desired password: &nbsp; &nbsp;</td>
                <td><input type="password" id="password" name="password" placeholder="********"></td>
              </tr>
              <td align="left">Confirm Password: &nbsp; &nbsp;</td>
              <td><input type="password" id="password" name="password_confirm" placeholder="********"></td>
              </table>
               <!--input type="Submit" name="submit" id="sub"-->
               <br>
               <button type="submit" name="submit">Sign-up</button>
            </form>
         </div>


      </header>
   </body>
</html>