<?php 
    include'pdoDB_connect.php';
    session_start();
    
    //This will search for the name of the product
    //
    if(isset($_POST['btnsave'])){

        //$id = $_POST['id'];
        $name = $_POST["txtname"];
        $price = $_POST["txtprice"];
        $image = $_POST["image"];
        $desc = $_POST["item_desc"];
        

    if(!empty($name && $price && $image && $$desc)){

    $insert = $pdo->prepare("INSERT  INTO 
     sir_inventory(name,price,image,desc) 
     VALUES(:name,:price,:image,:desc)");

    //$insert->bindParam(':id',$id);
    $insert->bindParam(':name',$name);
    $insert->bindParam(':price',$price);
    $insert->bindParam(':image',$image);
    $insert->bindParam(':desc',$desc);
    $insert->bindParam(':code',$code);
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

    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $desc = $_POST['item_desc'];
    $code = $_POST['code'];

    if(!empty($name && $price && $image && $desc && $code)){

        $update = $pdo->prepare("update sir_inventory SET
        name=:name,price=:price,image=:image,desc=:item_desc where code=:code");

        $update->bindParam(':id',$id);
        $update->bindParam(':name',$name);
        $update->bindParam(':price',$price);
        $update->bindParam(':image',$image);
        $update->bindParam(':desc',$desc);

        $update->execute();

        if($update->rowCount()){

            echo'Data Updated';
        }else{

            echo'HAHA, Try again Kid(The update failed)';
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
        <form action="" method="post">

    <?php

    if(isset($_POST['btnedit'])){

        $select = $pdo->prepare("select * from sir_inventory 
        where code=".$_POST['btnedit']);

        $select->execute();

        if($select){
            $row = $select->fetch(PDO::FETCH_OBJ);


        echo'
        <p><input type="text" name="id" value="'.$row->id.'"></p>
        <p><input type="text" name="txtname" value="'.$row->name.'"></p>
        <p><input type="text" name="code" value="'.$row->code.'"></p>
        <p><input type="text" name="txtprice" value="'.$row->price.'"></p> 
        <p><input type="url"id="link" name="image" value="'.$row->image.'"></p>
        <p><input type="text" name="item_desc" value="'.$row->desc.'"></p>
        <button type="submit" name="btnupdate">Update</button>
        <button type="submit" name="btncancel">Cancel</button>
        

        ';
        }

    }else{

        echo'

        <p><input type="text" name="id" placeholder="id"></p>
        <p><input type="text" name="txtname"placeholder="Drink Name"></p>
        <p><input type="number" step="0.01" name="txtprice" placeholder="$0.00"></p>
    <p><input type="url"id="link" name="image_link" placeholder="https://drive.google.com/drive/folders/1FzcoeK_PwqGCGqmL7OdlxBTIv8Ieqbp6?usp=sharing "></p>
        <p><input type="text" name="item_desc" placeholder="Drink desc"></p>
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
        <th>Price </th>
        <th>Image</th>
        <th>Item description</th>
        <th>Edit </th>
        <th>Delete </th>


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
    <td>'.$row->price.'</td>
    <td>'.$row->image.'</td>
    <td>'.$row->desc.'</td>
    <td><button type="submit" value="'.$row->id.'">Edit</button</td>
    <td><button type="submit" value="'.$row->id.'">Delete</button</td>
    
    </tr>
    
    
    ';
}



?>



        </tbody>
</table>

</form>

    </body>



</html>
