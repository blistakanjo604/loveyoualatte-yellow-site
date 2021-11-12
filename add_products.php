<?php
    include 'includes/pdoDB_connect.php';
    session_start();
    if ($_SESSION['logged'] != true) {
      	header("Location: login.php");
         exit();
      }

    //This will search for the name of the product
    //
    if(isset($_POST['btnsave'])){


        $name = $_POST['txtname'];
        $code = $_POST['pcode'];
        $price = $_POST['txtprice'];
        $image = $_POST['pimage'];
        $desc = $_POST['item_desc'];


    if(!empty($name && $code && $price && $image && $desc)){

     $insert = $pdo->prepare("INSERT INTO sir_inventory(name,code,price,image,idesc) VALUES(:name,:code,:price,:image,:idesc)");

     // $insert = $pdo->prepare("INSERT INTO `testing`.`sir_inventory` (`id`, `name`, `code`, `price`, `image`, `desc`) VALUES ('20', '$name', '$code', '$price', '$image', '$desc');");

     // INSERT INTO `testing`.`sir_inventory` (`name`, `code`, `price`, `image`, `desc`) VALUES ('broke', 'p1069', '12.99', 'img/espresso.jpeg', 'this is a description');

     // INSERT INTO `testing`.`sir_inventory` (`id`, `name`, `code`, `price`, `image`, `desc`) VALUES ('19', 'Brioke', 'p1069', '12.99', 'img/mocha.jpeg', 'this is a description');



    $insert->bindParam(':name',$name);
    $insert->bindParam(':code',$code);
    $insert->bindParam(':price',$price);
    $insert->bindParam(':image',$image);
    $insert->bindParam(':idesc',$desc);

    $insert->execute();

    if($insert->rowCount()){

        echo'Insert successfull';

    }else{
        echo'Insert failed';
    }

    }

 else{

    echo'Feilds are Empty';
 }//End of the save btn code
}
 //Conditions for update btn
 if(isset($_POST['btnupdate'])){



    $name = $_POST['txtname'];
    $code = $_POST['pcode'];
    $price = $_POST['txtprice'];
    $image = $_POST['pimage'];
    $desc = $_POST['item_desc'];
    $id = $_POST['txtid'];

    if(!empty($name && $code && $price && $image && $desc)){
        //It is table name first then a placeholder name that is bond to our $ variables above
        //These variables come from the txt input fields that request employee input
        $update = $pdo->prepare("update sir_inventory SET name=:name,code=:code,price=:price,image=:image,idesc=:idesc where id=".$id);

        $update->bindParam(':name',$name);
        $update->bindParam(':code',$code);
        $update->bindParam(':price',$price);
        $update->bindParam(':image',$image);
        $update->bindParam(':idesc',$desc);


        $update->execute();

        if($update->rowCount()){

            echo'Data Updated';
        }else{

            echo'Try again Kid(The update failed)';
        }

    }else{

        echo'These feilds can not be empty';
    }

 }
?>
<!DOCTYPE html>
<html lang="en">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <head>
      <title>☕ Inventory 🍵</title>
      <script src="https://use.typekit.net/axs3axn.js"></script>
      <script>try{Typekit.load({ async: true });}catch(e){}</script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
      <!--link rel="stylesheet" type="text/css" href="css/main2.css"-->
      <link rel = "icon" href = "img/site-icon.webp" type = "image/x-icon">
      <link rel="stylesheet" href="css/hamburger.css">
    </head>

    <body>

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
                            echo '<li><a href="add_products.php">Add Item</a></li>';
                            echo '<li><a href="update_products.php">Update Item</a></li>';
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

      <br><br><br><br>
        <form action="" method="post">

    <?php
    //Once you press Edit in the table the Save btn
    //will become the Update btn
    if(isset($_POST['btnedit'])){

        $select = $pdo->prepare("select * from sir_inventory
        where id=".$_POST['btnedit']);

        $select->execute();

        if($select){
            $row = $select->fetch(PDO::FETCH_OBJ);

        //After $row-> variable this is the table name
        echo'

        <p><input type="text" name="txtname" value="'.$row->name.'"></p>
        <p><input type="text" name="pcode" value="'.$row->code.'"></p>
        <p><input type="text" name="txtprice" value="'.$row->price.'"></p>
        <p><input type="text"id="link" name="pimage" value="'.$row->image.'"></p>
        <p><input type="text" name="item_desc" value="'.$row->idesc.'"></p>
        <p><input type="hidden" name="txtid" value="'.$row->id.'"></p>
        <button type="submit" name="btnupdate">Update</button>
        <button type="submit" name="btncancel">Cancel</button>


        ';
        }

    }else{

        echo'


        <p><input type="text" name="txtname"placeholder="Drink Name"></p>
        <p><input type="text" name="pcode" placeholder="p1019"></p>
        <p><input type="number" step="0.01" name="txtprice" placeholder="$0.00"></p>
        <p><input type="text"id="link" name="pimage" placeholder="img/cappuccino.jpeg"></p>
        <p><input type="text" name="item_desc" placeholder="Drink desc"></p>
        <p><input type="hidden" name="txtid"></p>
        <input type="submit" value="Save" name="btnsave">

        ';
    }

    ?>
    <br>
    <br>

    <br>
            <table id="inventorytable" border="3">
    <thead>
        <th>ID  </th>
        <th>Name</th>
        <th>Item Code</th>
        <th>Price </th>
        <th>Image</th>
        <th>Item description</th>
        <th>Edit </th>


    </thead>
        <tbody>
        <?php

$select = $pdo->prepare("select * from sir_inventory");

$select->execute();
echo"<pre>";

while($row = $select->fetch(PDO::FETCH_OBJ)){

    echo'
    <tr>
    <td>'.$row->id.'</td>
    <td>'.$row->name.'</td>
    <td>'.$row->code.'</td>
    <td>'.$row->price.'</td>
    <td>'.$row->image.'</td>
    <td>'.$row->idesc.'</td>
    <td><button type="submit" value="'.$row->id.'" name="btnedit">Edit</button</td>

    </tr>


    ';
}



?>



        </tbody>
</table>

</form>

    </body>



</html>
