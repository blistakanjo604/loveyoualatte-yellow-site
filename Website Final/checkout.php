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
      $dbServername = "localhost";
      $dbUsername = "yellow";
      $dbPassword = "YellowTA@m-!02Server";

      $conn = new mysqli($dbServername, $dbUsername, $dbPassword);

      $checkout_name = $_SESSION['user'];
    //  $cart = $_SESSION['cart_item'];
      $checkout_cart = array_merge($_SESSION["cart_item"],$itemArray);
      //$db_handle->runQuery("INSERT INTO `testing`.`checkout` (`user`, `cart`) VALUES ('$checkout_name', '$checkout_cart')");
      $sql = ("INSERT INTO `testing`.`checkout` (`user`, `cart`) VALUES ('giowashere', 'coffee');");

      $conn->query($sql);
      
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

                  <?php
                     if($_SESSION['logged']==true)
                       {
                          if($_SESSION['account']=='employee') {
                            echo '<h3> Employee Name: ';
                            echo $_SESSION['user'];
                            echo '</h3>';
                            echo '<h3> Employee Receipt Number: ';
                            echo rand(1, 1000000);
                            echo '</h3>';
                            date_default_timezone_set("America/New_York");
                            echo '<h4>';
                            echo date("Y-m-d h:i:sa");
                            echo '</h4>';
                          }

                          else {
                            echo '<h3> User Receipt for: ';
                            echo $_SESSION['user'];
                            echo '</h3>';
                            echo '<h3> Receipt Number: ';
                            echo rand(1, 1000000);
                            echo '</h3>';
                            date_default_timezone_set("America/New_York");
                            echo '<h4>';
                            echo date("Y-m-d h:i:sa");
                            echo '</h4>';
                          }
                       }
                     elseif($_SESSION['logged']==false)
                       { ?>

                         <h3>
                         Guest Receipt Number: <?php echo rand(1, 1000000); ?> <h3>
                         <h4><?php date_default_timezone_set("America/New_York"); echo date("Y-m-d h:i:sa"); ?></h4>


                      <?php } ?>





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
                        <td align=left><?php echo $item["name"]; ?></td>
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
