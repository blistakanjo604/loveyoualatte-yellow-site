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
          <h1 class=forte>☕ Love You A Latte Menu 🍵</h1>
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
</div>

      <hr> <br>

  <center>

      <?php
      session_start();
      //initialize sessions
      //Define the products and cost
      // include_once 'db_connect.php';
      $products = array(
          "Cappuccino",
          "Drip Coffee",
          "Latte",
          "Espresso",
          "Machiato",
          "Mocha"
      );
      $amounts = array(
          "9.99",
          "5.99",
          "7.99",
          "4.99",
          "6.99",
          "8.99"
      );

      //Load up session
      if (!isset($_SESSION["total"])) {
          $_SESSION["total"] = 0;
          for ($i = 0;$i < count($products);$i++) {
              $_SESSION["qty"][$i] = 0;
              $_SESSION["amounts"][$i] = 0;
          }
      }
     if (isset($_SESSION["cart"])) {
         ?>
      <h2>Receipt</h2>
      <table>
      <tr>
      <th>Product</th>
      <th width="10px">&nbsp;</th>
      <th>Qty</th>
      <th width="10px">&nbsp;</th>
      <th>Amount</th>
      <th width="10px">&nbsp;</th>
      </tr>
      <?php
         $total = 0;
         foreach ($_SESSION["cart"] as $i) {
             ?>
      <tr>
      <td><?php echo($products[$_SESSION["cart"][$i]]); ?></td>
      <td width="10px">&nbsp;</td>
      <td><?php echo($_SESSION["qty"][$i]); ?></td>
      <td width="10px">&nbsp;</td>
      <td><?php echo($_SESSION["amounts"][$i]); ?></td>
      <td width="10px">&nbsp;</td>
      </tr>
      <?php
             $total = $total + $_SESSION["amounts"][$i];
         }
         $_SESSION["total"] = $total; ?>
      <tr>
      <td colspan="7"><br><br>Total : <?php echo($total); ?></td>
      </tr>
      </table>
      <?php
     }
     ?>

   </center>






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
