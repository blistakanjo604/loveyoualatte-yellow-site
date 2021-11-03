<?php
   session_start();
   require_once("cart_connect.php");
   $db_handle = new DBController();
   if(!empty($_GET["action"])) {
   switch($_GET["action"]) {
   	case "add":
   		if(!empty($_POST["quantity"])) {
   			$productByCode = $db_handle->runQuery("SELECT * FROM products WHERE code='" . $_GET["code"] . "'");
   		//	$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
   		// ^^ Code above is the array that includes the image from database pull
   			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
   			if(!empty($_SESSION["cart_item"])) {
   				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
   					foreach($_SESSION["cart_item"] as $k => $v) {
   							if($productByCode[0]["code"] == $k) {
   								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
   									$_SESSION["cart_item"][$k]["quantity"] = 0;
   								}
   								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
   							}
   					}
   				} else {
   					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
   				}
   			} else {
   				$_SESSION["cart_item"] = $itemArray;
   			}
   		}
   	break;
   	case "remove":
   		if(!empty($_SESSION["cart_item"])) {
   			foreach($_SESSION["cart_item"] as $k => $v) {
   					if($_GET["code"] == $k) {
               if($_SESSION["cart_item"][$k]["quantity"] > 1) {
                 $_SESSION["cart_item"][$k]["quantity"]--;
               }
               else {
               unset($_SESSION["cart_item"][$k]);
             }
             }
   					if(empty($_SESSION["cart_item"])) {
   						unset($_SESSION["cart_item"]);
             }
   			}
   		}
   	break;
   	case "empty":
   		unset($_SESSION["cart_item"]);
   	break;
   }
   }
   ?>
<!DOCTYPE html>
<html lang=en>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel = "icon" href = "img/site-icon.webp" type = "image/x-icon">
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
      <hr>
      <br><br>
      <center>
        <!-- Start Receipt Contents -->
         <div>
            <h2>Receipt</h2>
            <?php
               if(isset($_SESSION["cart_item"])){
                   $total_quantity = 0;
                   $total_price = 0;
               ?>
            <table>
               <tbody>
                  <tr>
                     <th>&nbsp; Product &nbsp;</th>
                     <!--th style="text-align:left;">Code</th-->
                     <th>&nbsp; Quantity &nbsp;</th>
                     <th>&nbsp; Unit Price &nbsp;</th>
                     <th>&nbsp; Price</th>
                  </tr>
                  <?php
                     foreach ($_SESSION["cart_item"] as $item){
                         $item_price = $item["quantity"]*$item["price"];
                     ?>
                  <tr>
                     <!--td><img src="<!--?php echo $item["image"]; ?>" class="cart-item-image" /><!--?php echo $item["name"]; ?--><!--/td-->									 <!--Remove all comments in this line to make images work again-->
                     <td align=center><?php echo $item["name"]; ?></td>
                     <!--td><!--?php echo $item["code"]; ?--><!--/td-->
                     <td align=center><?php echo $item["quantity"]; ?></td>
                     <td align=center><?php echo "$".$item["price"]; ?></td>
                     <td align=center><?php echo "$". number_format($item_price,2); ?></td>
                  </tr>
                  <?php
                     $total_quantity += $item["quantity"];
                     $total_price += ($item["price"]*$item["quantity"]);
                     }
                     ?>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                     <td colspan="2" align="right">&nbsp;</td>
                     <td align="left">Items: &nbsp;<?php echo $total_quantity; ?></td>
                     <td align="right" colspan="2"><strong>TOTAL: &nbsp; <?php echo "$ ".number_format($total_price, 2); ?></strong></td>
                     <td></td>
                  </tr>
               </tbody>
            </table>
            <br><br><a id="btnEmpty" href="menu.php?action=empty">pay in full</a>
            <?php
               } else {
               ?>
            <div class="no-records">nothing to checkout <a href="menu.php">go back</a> </div>
            <?php
               }
               ?>
         </div>
         <br>
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
