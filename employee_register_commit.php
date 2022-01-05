<?php session_start();
if ($_SESSION['logged'] != true) {
   header("Location: login.php");
     exit();
  }?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel="stylesheet" href="css/hamburger.css">
      <link rel = "icon" href = "img/site-icon.webp" type = "image/x-icon">
      <title>🚪 Register Employee 👤</title>
   </head>
   <body>
      <?php include 'includes/hamburger.php' ?>
      <header class="showcase">
         <div class="showcase-inner">
            <h1>🚪 Register Employee 👤</h1>
            <form action=employee_register_commit.php method="POST">
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
            <?php
               $username         = $_POST['username'];
               $password         = $_POST['password'];
               $password_confirm = $_POST['password_confirm'];
               $hash             = password_hash($password, PASSWORD_DEFAULT);

               // Validate password strength
               $uppercase    = preg_match('@[A-Z]@', $password);
               $lowercase    = preg_match('@[a-z]@', $password);
               $number       = preg_match('@[0-9]@', $password);
               $specialChars = preg_match('@[^\w]@', $password);

               $usernameCheckCase    = preg_match('@[A-Z]@', $username);
               $usernameCheckSpaces  = preg_match("/\\s/", $username);
               $usernameCheckNumbers = preg_match('@[0-9]@', $username);
               $usernameCheckSpecial = preg_match('@[^\w]@', $username);



               if ($usernameCheckCase || $usernameCheckSpaces || $usernameCheckNumbers || $usernameCheckSpecial) {
                   echo '<br>Username should ONLY have lowercase letters and no spaces.';
               }


               elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                   echo '<br>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
               }

               else {

                   if ($password_confirm == $password) {
                       include_once 'includes/init_connect.php';


                       $sql = "INSERT INTO `testing`.`kyle_accounts` (`username`, `password`) VALUES ('$username', '$hash');";


                       if ($conn->query($sql) === true) {
                           echo "<br><h2>Employee added successfully</h2>";
                       } else {
                           echo "Error: " . $sql . "<br>" . $conn->error;
                       }

                       $conn->close();



                   }

                   else {

                       echo '<br>Passwords do not match.';

                   }
               }


               ?>
         </div>
      </header>
   </body>
</html>
