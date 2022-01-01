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
            }
    }
}
    $con_category = mysqli_connect("localhost", "yellow", "YellowTA@m-!02Server", "loveyoualatte");
    $sql_category = " SELECT product_category FROM category";
    $result_category = mysqli_query($con_category, $sql_category);
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
              <button id=btnCheckOut type="submit" name="btnsearch">Update Item</button>
               <button id=btnCheckOut type="submit" name="btnadd">Add Item</button>
            </form>


            <?php
               if(isset($_POST['btnadd']))
               {
                $con = mysqli_connect("localhost", "yellow", "YellowTA@m-!02Server", "loveyoualatte");
                $sqlstate = " SELECT product_category FROM category";
                $res = mysqli_query($con, $sql);
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
                 <td>';?>
                  <select name="category">
                  <option value= "hot"> hot </option>
                  <option value= "frozen"> frozen </option>
                  <option value= "iced"> iced </option>
                  </select>
                <?php echo'
                </td>
                </tr>
                 </table>

                 <br>
                 <button type="submit" name="add_item">&nbsp; Commit Changes &nbsp;</button>
                 </form>
                 ';
                }


                 if(isset($_POST['btnsearch']))
                 {
                   echo '<h3>Search for an Item</h3>';
                   echo 'Please enter the name of the product you intend to update';

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
                    $description = $_POST['desc'];
                    $category = $_POST['category'];

                    $sql = "UPDATE testing.kyle_products SET `name` = '$name', `code` = '$code', `price` = '$price', `image` = '$image', `desc` = '$description', `category` = '$category' WHERE (`code` = '$code');";


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


                  if(isset($_POST['search_item']))
                  {
                    include_once 'includes/init_connect.php';


                    $name = $_POST['name'];
                    $code = $_POST['code'];
                    $price = $_POST['price'];
                    $image = $_POST['image'];
                    $desc = $_POST['desc'];
                    $category = $_POST['category'];


                    $search_term = $_POST['search_term'];

                    $sql = "SELECT * FROM testing.kyle_products WHERE NAME LIKE '%$search_term%'";

                    $result = $conn->query($sql);


                    echo '<h3>Update an item</h3>';
                    echo 'The fields below have the product information of the item you searched, please make your alterations then commit the changes to update the product.';







                    if ($result->num_rows > 0){
                      echo '                      <form class="" action="inventory_management.php" method="post">

                      <table>
                      <tr>
                      <th>&nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;</th>
                      <th>&nbsp;  &nbsp;</th>
                      <th>&nbsp;  &nbsp;</th>
                      <th>&nbsp;  &nbsp;</th>
                      <th>&nbsp;  &nbsp;</th>



                      </tr>

                      ';
                     while($row = $result->fetch_assoc() ){
                        //echo "<tr><td align=left> <input type =text"  .$row['name']. "&nbsp;&nbsp;&nbsp;&nbsp;</td><td>" .$row['code']. "</td><td>" .$row['price']. "</td></tr>" .$row;
                        echo'
                            <table>

                        <th>
                        <tr> </tr>
                        <tr> </tr>
                        </th>

                        <tr>
                        <td align="left">Rename: &nbsp; &nbsp;</td>
                        <td><input type="text" name="name" id="name" value="'.$row["name"].'"></td>
                        </tr>


                        <input readonly type="hidden" name="code" id="code" value='.$row["code"].'>


                        <tr>
                        <td align="left">Change Price: &nbsp; &nbsp;</td>
                        <td><input type="text" name="price" id="price" value='.$row["price"].'></td>
                        </tr>

                        <tr>
                        <td align="left">Change Image: &nbsp; &nbsp;</td>
                        <td><input type="text" id="link" name="image" id="image" value='.$row["image"].'></td>
                        </tr>

                        <tr>
                        <td align="left">New Description: &nbsp; &nbsp;</td>
                        <td><input type="text" name="desc" id="desc" value="'.$row["desc"].'"></td>
                        </tr>

                        <tr>
                        <td align="left">Current Category: &nbsp; &nbsp;</td>
                        <td>'.$row["category"].'</td>
                        </tr>

                        <tr>
                        <td align="left">Change Category: &nbsp; &nbsp;</td>
                        <td>';?>

                      <select name="category">
                      <option value="hot">hot</option>
                      <option value="frozen">frozen</option>
                      <option value="iced">iced</option>
                      </select>



                        <?php echo'
                        </td>
                        </tr>

                        </table>
                        <br>
                        <button type="submit" name="update_item">&nbsp; Update and Commit Changes &nbsp;</button>
                        </form>
                        <br><br><br><br>
                        ';'';
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
         </div>
         <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      </header>
   </body>
</html>
