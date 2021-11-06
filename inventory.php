

  <?php
  include'pdoDB_connect.php';
  session_start();



   if(isset($_POST['submit'])){
       $f__name = $_FILES['myfile']['name'];
       $f_tmp = $_FILES['myfile']['tmp_name'];
       $store = "upload/".$f_name;

      if (move_uploaded_file($f_tmp,$store)){

            echo'file was uploaded';
      } else {
          echo'Failed to upload file';
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
    <div class="hamburger"><div></div></div>
    <div class="menu">
      <div>
        <div>
          <ul> <!-- add pages/ once we clean up the sites directory  -->
            <li><a href="index.php">Home</a></li>
            <li><a href="FAQ.php">FAQ</a></li>
            <li><a href="ContactUs.php">Contact Us</a></li>
	        <li><a href="product_menu.php">Product Menu</a></li>
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

  <header class="showcase">
    <div class="container showcase-inner">
      <h1>Love you A Latte</h1>
      <a href="index.php" class="btn">Home</a><br><br>
      </header>
<div class="form-center">
    <form action="" method="POST">
    <input type="number" id="iId" name="inventory_id">
    <label for="iId">ID</label>
    <input type="text" id="desc" name="item_description">
    <label for="desc">Item description</label>
    <input type="number" step="0.01" id="price" name="price">
    <label for="price">Price</label>
    <input type="url"id="link" name="image_link" placeholder="https://drive.google.com/drive/folders/1FzcoeK_PwqGCGqmL7OdlxBTIv8Ieqbp6?usp=sharing ">
    <label for="link">URL for Image</label>
    <input type="submit" value="submit" name="btnsubmit">
            
            <br>
            <table id="inventorytable" border="1">
    <thead>
        <th>ID  </th>
        <th>Item description</th>
        <th>Price </th>
        <th>Image</th>
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
    <td>'.$row->desc.'</td>
    <td>'.$row->price.'</td>
    <td>'.$row->image.'</td>
    <td><button type="submit" value="'.$row->id.'">Edit</button</td>
    <td><button type="submit" value="'.$row->id.'">Delete</button</td>
    
    </tr>
    
    
    ';
}



?>



        </tbody>
</table>


    </form>
    <form action="" method="POST"
    enctype="multipart/form-data">
    <input type="file" id="file" name="yourfile">
    <label for="file">Image</label>
    <input type="submit" value="upload" name="submit">
</form>
</div>

<br>


      
      
      
			
            
    </div>
 
</body>
</html>

