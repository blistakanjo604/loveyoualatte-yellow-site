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
    $_POST['btnMod'] = 1;
   break;
   case "addModifier":
      if(!empty($_POST["quantity"])) {
        $productByCode = $db_handle->runQuery("SELECT * FROM (SELECT * FROM kyle_products UNION SELECT * FROM kyle_products_mods) AS U WHERE U.code='" . $_GET["code"] . "'");
      $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
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
     $_POST['btnMod'] = 1;
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
      $checkout_name = $_SESSION['user'];
      $cart_list = $_SESSION['cart_item'];
      $checkout_cart = serialize($cart_list);

      $db_handle->runQuery("INSERT INTO `testing`.`checkout` (`user`, `cart`) VALUES ('$checkout_name', '$checkout_cart');");

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
      <title>☕ Products 🍵</title>
   </head>
   <body>
   <?php // print "<body  onScroll=\"document.cookie='ypos=' + window.pageYOffset\" onLoad='window.scrollTo(0,$ypos)'>"; ?>
   <?php include 'includes/hamburger.php' ?>
   <!--Start Product List-->
   <header class="showcase-products">
      <div class="showcase-products-inner">
         <div id="product-grid">
            <br>
            <div class="txt-heading">
               <h1>☕ Products 🍵</h1>
            </div>
            <form action="menu.php" method="post">
               <!-- <button id=btnCheckOut type="submit" name="btnMod">Modifiers</button> -->
               <button id=btnCheckOut type="submit" name="btnFrozen">Frozen Drinks</button>
               <button id=btnCheckOut type="submit" name="btnIced">Iced Drinks</button>
               <button id=btnCheckOut type="submit" name="btnHot">Hot Drinks</button>
               <button id=btnCheckOut type="submit" name="btnAll">All Items</button>
               <a id="btnCheckOut" href="cart.php">View Cart</a>

               <?php 

if(isset($_POST['btnMod']))
{ ?>

<form action="menu.php" method="post">
               <!-- <button id=btnCheckOut type="submit" name="btnMod">Modifiers</button> -->
               <button id=btnCheckOut type="submit" name="btnAll">Done Modifying</button>
            </form><br>

            <?php } ?>



            </form>
            <br><br>

            <?php
               if(isset($_POST['btnAll']))
               {
                 $product_array = $db_handle->runQuery("SELECT * FROM kyle_products ORDER BY id ASC");
                    if (!empty($product_array)) {
                      foreach($product_array as $key=>$value){

               ?>
            <div class="product-item">
               <form method="post" action="menu.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                  <div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>" title="<?php echo $product_array[$key]["desc"]; ?>"></div>
                  <div class="product-tile-footer">
                     <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                     <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                     <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                  </div>
               </form>
            </div>
            <?php
               }
               }
               }
               ?> 





            <?php
               if(isset($_POST['btnAllTemp']))
               {
                 $product_array = $db_handle->runQuery("SELECT * FROM kyle_products ORDER BY id ASC");
                    if (!empty($product_array)) {
                      foreach($product_array as $key=>$value){

               ?>
            <div class="product-item">
               <form method="post" action="menu.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                  <div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>" title="<?php echo $product_array[$key]["desc"]; ?>"></div>
                  <div class="product-tile-footer">
                     <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                     <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                     <?php
                     $con = mysqli_connect("localhost", "yellow", "YellowTA@m-!02Server", "loveyoualatte");
                     $sql = " Select product_category from category";
                     $res = mysqli_query($con, $sql);
                     ?>
                     <body>
                        Select Type of Drink :
                        <select>
                        <option value="">--- Select ---</option>
                           <?php while( $rows = mysqli_fetch_array($res)) {
                              ?>
                              <option value="<?php echo $rows['product_category']; ?> " > <?php echo $rows['product_category']; ?> </option>
        
                           <?php    
                           }    
                           ?>

                        </select>

                     </body>
                     
                     <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                  </div>
               </form>
            </div>
            <?php
               }
               }
               }
               ?>
            <?php
               if(isset($_POST['btnHot']))
               {
                 $product_array = $db_handle->runQuery("SELECT * FROM kyle_products WHERE category='hot' ORDER BY id ASC");
                    if (!empty($product_array)) {
                      foreach($product_array as $key=>$value){

               ?>
            <div class="product-item">
               <form method="post" action="menu.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                  <div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>" title="<?php echo $product_array[$key]["desc"]; ?>"></div>
                  <div class="product-tile-footer">
                     <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                     <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                     <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                  </div>
               </form>
            </div>
            <?php
               }
               }
               }
               ?>
            <?php
               if(isset($_POST['btnFrozen']))
               {
                 $product_array = $db_handle->runQuery("SELECT * FROM kyle_products WHERE category='frozen' ORDER BY id ASC");
                    if (!empty($product_array)) {
                      foreach($product_array as $key=>$value){

               ?>
            <div class="product-item">
               <form method="post" action="menu.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                  <div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>" title="<?php echo $product_array[$key]["desc"]; ?>"></div>
                  <div class="product-tile-footer">
                     <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                     <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                     <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                  </div>
               </form>
            </div>
            <?php
               }
               }
               echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
               }
               ?>               
            <?php
               if(isset($_POST['btnIced']))
               {
                 $product_array = $db_handle->runQuery("SELECT * FROM kyle_products WHERE category='iced' ORDER BY id ASC");
                    if (!empty($product_array)) {
                      foreach($product_array as $key=>$value){

               ?>
            <div class="product-item">
               <form method="post" action="menu.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                  <div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>" title="<?php echo $product_array[$key]["desc"]; ?>"></div>
                  <div class="product-tile-footer">
                     <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                     <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                     <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                  </div>
               </form>
            </div>
            <?php
               }
               }
               echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
               }
               ?>              
            <?php
               if(isset($_POST['btnMod']))
               {
                 $product_array = $db_handle->runQuery("SELECT * FROM kyle_products_mods ORDER BY id ASC");
                    if (!empty($product_array)) {
                      foreach($product_array as $key=>$value){

               ?>
            <div class="product-item">

               <form method="post" action="menu.php?action=addModifier&code=<?php echo $product_array[$key]["code"]; ?>">
                  <div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>" title="<?php echo $product_array[$key]["desc"]; ?>"></div>
                  <div class="product-tile-footer">
                     <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                     <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                     <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                  </div>
               </form>

               
            </div>
            <?php
               }
               }

               
               echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';

               }
               ?>
            <?php
               if(isset($_POST['ModPrompt']))
               { ?>
            <div>
               <br><br>
               <h3>Would you like to modify your last item?</h3>
               <br>
               <form action="menu.php" method="post">
                  <button id=btnCheckOut type="submit" name="btnAll">No</button>
                  <button id=btnCheckOut type="submit" name="btnMod">Yes</button>
               </form>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <?php
               }

                ?>
            <?php
               if(!isset($_POST['btnAll']) && !isset($_POST['btnIced']) && !isset($_POST['btnHot']) && !isset($_POST['btnMod']) && !isset($_POST['ModPrompt']) && !isset($_POST['btnFrozen'])) {
                 $product_array = $db_handle->runQuery("SELECT * FROM kyle_products ORDER BY id ASC");
                    if (!empty($product_array)) {
                      foreach($product_array as $key=>$value){

               ?>
            <div class="product-item">
               <form method="post" action="menu.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                  <div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>" title="<?php echo $product_array[$key]["desc"]; ?>"></div>
                  <div class="product-tile-footer">
                     <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                     <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                     <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                  </div>
               </form>
            </div>
            <?php
               }
               }
               }
               ?>
         </div>
         <!--Start Cart Display-->
         <a id="btnCheckOut" href="cart.php">View Cart</a>
      </div>
      </div>
      <br><br>
   </header>
   </body>
</html>
