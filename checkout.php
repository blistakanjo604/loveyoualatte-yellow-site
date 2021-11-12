<?php
   session_start();
   require_once("includes/cart_connect.php");
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
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel = "icon" href = "img/site-icon.webp" type = "image/x-icon">
      <link rel="stylesheet" href="css/hamburger.css">
      <title>Love you A Latte (Yellow 02 Capstone)</title>
   </head>
   <body>
    <?php include 'includes/hamburger.php' ?>
      <!-- Start Receipt Contents -->
      <header class="showcase">
         <div class="showcase-inner">
           <div id="shopping-cart">
              <div class="txt-heading">
                 <h1>🧾 Receipt 🧾</h1>
                 <h3>Receipt Number: <?php echo rand(1, 1000000); ?>
                 <h4><?php date_default_timezone_set("America/New_York"); echo date("Y-m-d h:i:sa"); ?></h4>
              </div>
			<br>
			<br>
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
                     <th>&nbsp; Item Price &nbsp;</th>
                     <th>&nbsp; Subtotal</th>
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
            <br>
			      <a id="btnCheckOut" href="menu.php">Go Back to Products</a>
            <a id="btnCheckOut" href="cart.php">Go Back to Cart</a>
			      <a id="btnCheckOut" href="menu.php?action=empty">Pay in Full</a>
            <?php
               } else {
               ?>
            <div>nothing to checkout <a href="menu.php">go back</a> </div>
            <?php
               }
               ?>
         </div>
       </div>
      </header>
   </body>
</html>
