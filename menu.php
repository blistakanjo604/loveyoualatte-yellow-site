<?php
   session_start();
   require_once("cart_connect.php");
   $db_handle = new DBController();
   if(!empty($_GET["action"])) {
   switch($_GET["action"]) {
   	case "add":
   		if(!empty($_POST["quantity"])) {
   			$productByCode = $db_handle->runQuery("SELECT * FROM kyle_products WHERE code='" . $_GET["code"] . "'");
   		$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'desc'=>$productByCode[0]["desc"], 'image'=>$productByCode[0]["image"]));
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

   $ypos = $_COOKIE["ypos"];
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
   <!--body-->
   <?php print "<body  onScroll=\"document.cookie='ypos=' + window.pageYOffset\" onLoad='window.scrollTo(0,$ypos)'>"; ?>
     <div class="menu-wrap">
         <input type="checkbox" class="toggler">
         <div class="hamburger">
            <div></div>
         </div>
         <div class="menu">
            <div>
               <div>
                  <ul>
                     <!-- add pages/ once we clean up the sites directory  -->
                     <li><a href="index.php">Home</a></li>
                     <li><a href="faq.php">FAQ</a></li>
                     <li><a href="contact.php">Contact Us</a></li>
                     <li><a href="menu.php">Product Menu</a></li>
                     <?php
                        if($_SESSION['logged']==true)
                          {
                            echo '<li><a href="login.php">Log-out</a></li>';
                            echo '<small class="menu-small">User Logged in: ';
                            echo $_SESSION['user'];
                            echo ' ☕ </small>';
                          }
                        elseif($_SESSION['logged']==false)
                          {
                            echo '<li><a href="login.php">Log-in</a></p>';
                          }
                        ?>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <!--Start Product List-->
      <header class="showcase-products">
         <div class="showcase-products-inner">
            <div id="product-grid">
               <br>
               <div class="txt-heading">
                  <h1>☕ Products 🍵</h1>
               </div>
               <?php
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
