<?php
   include 'includes/cart_connect.php';
   session_start();
   if ($_SESSION['logged'] != true) {
     	header("Location: login.php");
      exit();
     }

     $db_handle = new DBController();
     if(!empty($_GET["action"])) {
     switch($_GET["action"]) {
     	case "add":
     		if(!empty($_POST["quantity"])) {
     			$productByCode = $db_handle->runQuery("SELECT * FROM kyle_products WHERE code='" . $_GET["code"] . "'");
     		$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'desc'=>$productByCode[0]["desc"], 'id'=>$productByCode[0]["id"]));
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
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel="stylesheet" href="css/hamburger.css">
      <link rel = "icon" href = "img/site-icon.webp" type = "image/x-icon">
      <title>☕ Love you A Latte 🍵</title>
   </head>
   <body>
      <?php include_once 'includes/hamburger.php' ?>
      <header class="showcase-products">
         <div class="showcase-products-inner">
            <br><br><br>
            <h1>📥 Inventory Management 📤</h1>
            <form action="inventory_management.php" method="post">
              <button id=btnCheckOut type="submit" name="btnsearch">Search for an Item</button>
               <button id=btnCheckOut type="submit" name="btndelete">Delete Item</button>
               <button id=btnCheckOut type="submit" name="btnupdate">Update Item</button>
               <button id=btnCheckOut type="submit" name="btnadd">Add Item</button>
            </form>
            <?php
               if(isset($_POST['btnadd']))
               {
                 echo '<h3>Add an item</h3>';
                 echo '

                 <form class="" action="inventory_management.php" method="post">
                 <table>

                 <th>
                 <tr> </tr>
                 <tr> </tr>
                 </th>

                 <tr>
                 <td align="left">Product Name: &nbsp; &nbsp;</td>
                 <td><input type="text" name="name" placeholder="Black Tea"></td>
                 </tr>

                 <tr>
                 <td align="left">Code: &nbsp; &nbsp;</td>
                 <td><input type="text" name="code" placeholder="p10XX"></td>
                 </tr>

                 <tr>
                 <td align="left">Price: &nbsp; &nbsp;</td>
                 <td><input type="text" name="price" placeholder="79.99"></td>
                 </tr>

                 <tr>
                 <td align="left">Image: &nbsp; &nbsp;</td>
                 <td><input type="text" id="link" name="image" placeholder="default = img/drip_cof.jpeg"></td>
                 </tr>

                 <tr>
                 <td align="left">Description: &nbsp; &nbsp;</td>
                 <td><input type="text" name="desc" placeholder="Description…"></td>
                 </tr>

                 <tr>
                 <td align="left">Category: &nbsp; &nbsp;</td>
                 <td><input type="text" name="category" placeholder="hot, iced, or frozen"></td>
                 </tr>

                 </table>

                 <br>
                 <button type="submit" name="add_item">&nbsp; Commit Changes &nbsp;</button>
                 </form>
                 ';
                }

                if(isset($_POST['btnupdate']))
                {
                  echo '<h3>Update an item</h3>';
                  echo 'Please enter the CODE of the product that you want to change';
                  echo '

                  <br>

                  <form class="" action="inventory_management.php" method="post">

                  <table>

                  <tr>
                  <td align="left">CODE of Item to Edit: &nbsp; &nbsp;</td>
                  <td><input type="text" name="code" placeholder="p10XX"></td>
                  </tr>

                  </table>



                  <table>

                  <th>
                  <tr> </tr>
                  <tr> </tr>
                  </th>

                  <tr>
                  <td align="left">Rename: &nbsp; &nbsp;</td>
                  <td><input type="text" name="name" placeholder="Black Tea"></td>
                  </tr>

                  <tr>
                  <td align="left">Change Price: &nbsp; &nbsp;</td>
                  <td><input type="text" name="price" placeholder="79.99"></td>
                  </tr>

                  <tr>
                  <td align="left">Change Image: &nbsp; &nbsp;</td>
                  <td><input type="text" id="link" name="image" placeholder="default = img/drip_cof.jpeg"></td>
                  </tr>

                  <tr>
                  <td align="left">New Description: &nbsp; &nbsp;</td>
                  <td><input type="text" name="desc" placeholder="Description…"></td>
                  </tr>

                  <tr>
                  <td align="left">Change Category: &nbsp; &nbsp;</td>
                  <td><input type="text" name="category" placeholder="hot, iced, or frozen"></td>
                  </tr>

                  </table>
                  <br>
                  <button type="submit" name="update_item">&nbsp; Update and Commit Changes &nbsp;</button>
                  </form>
                  ';
                 }

                 if(isset($_POST['btndelete']))
                 {
                   echo '<h3>Delete an item</h3>';
                   echo 'Please enter the CODE of the product that you want to delete';
                   echo '

                   <form class="" action="inventory_management.php" method="post">
                   <table>

                   <th>
                   <tr> </tr>
                   <tr> </tr>
                   </th>

                   <tr>
                   <td align="left">CODE of Item to Delete: &nbsp; &nbsp;</td>
                   <td><input type="text" name="code" placeholder="p10XX"></td>
                   </tr>

                   </table>

                   <br>
                   <button type="submit" name="delete_item">&nbsp; Delete and Commit Changes &nbsp;</button>
                   </form>
                   ';
                  }

                  if(isset($_POST['btnsearch']))
                  {
                    echo '<h3>Search for an Item</h3>';
                    echo 'Please enter the name of the product that you are searching for ';
                    echo '

                    <form class="" action="inventory_management.php" method="post">
                    <table>

                    <th>
                    <tr> </tr>
                    <tr> </tr>
                    </th>

                    <tr>
                    <td align="left">Search: &nbsp; &nbsp;</td>
                    <td><input type="text" name="search_term" placeholder="…"></td>
                    </tr>

                    </table>

                    <br>
                    <button type="submit" name="search_item">&nbsp; Search for Item &nbsp;</button>
                    </form>
                    ';
                   }




                 if(isset($_POST['add_item']))
                 {
                   include_once 'includes/init_connect.php';

                   $name = $_POST['name'];
                   $code = $_POST['code'];
                   $price = $_POST['price'];
                   $image = $_POST['image'];
                   $desc = $_POST['desc'];
                   $category = $_POST['category'];

                   $sql = "INSERT INTO `testing`.`kyle_products` (`name`, `code`, `price`, `image`, `desc`, `category`) VALUES ('$name', '$code', '$price', '$image', '$desc', '$category');";


                   if ($conn->query($sql) === true)
                   {
                     echo "<br><h2>Item added successfully</h2>";
                   }
                   else
                   {
                     echo "Error: " . $sql . "<br>" . $conn->error;
                   }

                   $conn->close();


                 }

                 if(isset($_POST['update_item']))
                 {
                   include_once 'includes/init_connect.php';

                   $name = $_POST['name'];
                   $code = $_POST['code'];
                   $price = $_POST['price'];
                   $image = $_POST['image'];
                   $desc = $_POST['desc'];
                   $category = $_POST['category'];

                   $sql = "UPDATE `testing`.`kyle_products` SET `name` = '$name', `code` = '$code', `price` = '$price', `image` = '$image', `desc` = '$desc', `category` = '$category' WHERE (`code` = '$code');";


                   if ($conn->query($sql) === true)
                   {
                     echo "<br><h2>Item updated successfully</h2>";
                   }
                   else
                   {
                     echo "Error: " . $sql . "<br>" . $conn->error;
                   }

                   $conn->close();


                 }

                 if(isset($_POST['delete_item']))
                 {
                   include_once 'includes/init_connect.php';

                   $code = $_POST['code'];

                   $sql = "DELETE FROM `testing`.`kyle_products` WHERE (`code` = '$code');";


                   if ($conn->query($sql) === true)
                   {
                     echo "<br><h2>Item Deleted successfully</h2>";
                   }
                   else
                   {
                     echo "Error: " . $sql . "<br>" . $conn->error;
                   }

                   $conn->close();


                 }


                 if(isset($_POST['search_item']))
                 {
                   include_once 'includes/init_connect.php';

                   $search_term = $_POST['search_term'];

                   $sql = "SELECT * FROM testing.kyle_products WHERE NAME LIKE '%$search_term%'";

                   $result = $conn->query($sql);

                   if ($result->num_rows > 0){
                     echo '
                     <table>
                     <tr>
                     <th>&nbsp; Name &nbsp; &nbsp; &nbsp; &nbsp;</th>
                     <th>&nbsp; Code &nbsp;</th>
                     <th>&nbsp; Price &nbsp;</th>
                     </tr>

                     ';
                    while($row = $result->fetch_assoc() ){
                    	echo "<tr><td align=left>" .$row['name']. "&nbsp;&nbsp;&nbsp;&nbsp;</td><td>" .$row['code']. "</td><td>" .$row['price']. "</td></tr>";
                    }
                    echo '</table>';
                    }

                    else {
                    	echo "No Search Results Found";
                    }

                   $conn->close();


                 }




                   ?>
            <br><br>
            <h2>Live Table View:</h2>
            <br>
            <table style="table-layout: fixed;">
               <tr>
                  <th>&nbsp; Product &nbsp;</th>
                  <th>&nbsp; Code &nbsp;</th>
                  <th>&nbsp; Price &nbsp;</th>
                  <th>&nbsp; Image Link &nbsp;</th>
                  <th>&nbsp; Description &nbsp;</th>
                  <th>&nbsp; Category &nbsp;</th>
               </tr>
               <?php
                  $product_array = $db_handle->runQuery("SELECT * FROM kyle_products ORDER BY id ASC");
                  if (!empty($product_array)) {
                  	foreach($product_array as $key=>$value){
                  ?>
               <div>
                  <form method="post" action="inventory_management.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                     <!--div class="product-image"><img src="<!--?php echo $product_array[$key]["image"]; ?>"--><!--/div-->
                     <tr>
                        <td align=center><?php echo $product_array[$key]["name"]; ?></td>
                        <td align=center><?php echo $product_array[$key]["code"]; ?></td>
                        <td align=center><?php echo "$".$product_array[$key]["price"]; "  " ?></td>
                        <td align=center><?php echo $product_array[$key]["image"]; "  " ?></td>
                        <td align=center style="overflow: scroll; width:30%;"><?php echo $product_array[$key]["desc"]; ?></td>
                        <td align=center><?php echo $product_array[$key]["category"]; "  " ?></td>
                     </tr>
               </div>
               </form>
         </div>
         <?php
            }
            }
            ?>
         </table>
         </div>
         <br><br><br><br><br><br><br>
      </header>
   </body>
</html>
