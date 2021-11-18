<?php
   session_start();
   require_once("includes/cart_connect.php");
   $db_handle = new DBController();
   if(!empty($_GET["action"])) {
   switch($_GET["action"]) {
    case "add":
      if(!empty($_POST["quantity"])) {
        $productByCode = $db_handle->runQuery("SELECT * FROM (SELECT * FROM kyle_products UNION SELECT * FROM kyle_products_mods) AS U WHERE U.code='" . $_GET["code"] . "'");
      $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
      // Code below is the array that does not include the image from database pull
      //	$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
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
    $_POST['ModPrompt'] = 1;
    break;
    case "addFromMod":
    if(!empty($_POST["quantity"])) {
      $productByCode = $db_handle->runQuery("SELECT * FROM (SELECT * FROM kyle_products UNION SELECT * FROM kyle_products_mods) AS U WHERE U.code='" . $_GET["code"] . "'");
    $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
    // Code below is the array that does not include the image from database pull
    //	$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
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
        /* v---This is the code that removes just one item from cart---v*/
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
      <link rel="stylesheet" href="css/hamburger.css">
      <link rel = "icon" href = "img/site-icon.webp" type = "image/x-icon">
      <title>☕ Cart 🍵</title>
   </head>
   <body>
      <?php include 'includes/hamburger.php' ?>
      <!--Start Cart Display-->
      <header class="showcase">
         <div class="showcase-inner">
            <div id="shopping-cart">
               <div class="txt-heading">
                  <h1>🛒 Cart 🛍</h1>
               </div>
               <?php
                  if(isset($_SESSION["cart_item"])){
                  $total_quantity = 0;
                  $total_price = 0;
                  ?>
               <table class="tbl-cart" cellpadding="10" cellspacing="1">
                  <tbody>
                     <tr>
                        <th>&nbsp; Product &nbsp;</th>
                        <!--th style="text-align:left;">Code</th-->
                        <th>&nbsp; Quantity &nbsp;</th>
                        <th>&nbsp; Unit Price &nbsp;</th>
                        <th>&nbsp; Price &nbsp;</th>
                        <th>&nbsp; &nbsp; &nbsp; Action &nbsp; &nbsp;</th>
                     </tr>
                     <?php
                        foreach ($_SESSION["cart_item"] as $item){
                        $item_price = $item["quantity"]*$item["price"];
                        ?>
                     <tr>
                        <td style="text-align:left;"><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
                        <td style="text-align:center;"><?php echo $item["quantity"]; ?></td>
                        <td  style="text-align:center;"><?php echo "$ ".$item["price"]; ?></td>
                        <td  style="text-align:center;"><?php echo "$ ". number_format($item_price,2); ?></td>
                        <td style="text-align:center;"><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">❌</a></td>
                     </tr>
                     <?php
                        $total_quantity += $item["quantity"];
                        $total_price += ($item["price"]*$item["quantity"]);
                        $_SESSION['cart_count'] = $total_quantity;
                        }
                        ?>
                     <tr>
                        <td colspan="2" align="right">Total:</td>
                        <td align="right"><?php echo $total_quantity; ?></td>
                        <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
                        <td></td>
                     </tr>
                  </tbody>
               </table>
               <br>
               <a id="btnCheckOut" href="menu.php">Go Back to Products</a>
               <a id="btnCheckOut" href="checkout.php">Check-out</a>
               <a id="btnEmpty" href="cart.php?action=empty">Clear Cart</a>
               <?php
                  } else {
                  ?>
               <div class="no-records">Your Cart is Empty</div>
               <a id="btnCheckOut" href="menu.php">Go Back to Products</a>
               <?php
                  }
                  ?>
            </div>
         </div>
      </header>
   </body>
</html>
