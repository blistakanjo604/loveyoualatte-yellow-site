<?php

session_start();

require_once('db/CreateDb.php');
require_once('db/component.php');
require_once("db/header.php");

$_SESSION["product-qty"] = 0;

// create instance of Createdb class
$database = new CreateDb("loveyoualatte", "Productdb");

if (isset($_POST['add'])) {
    /// print_r($_POST['product_id']);

    $_SESSION["product-qty"] = $_SESSION["product-qty"] + 1;
    $_SESSION["product-qty"] = $_SESSION["product-qty"];

    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], "product_id");

        /* if(in_array($_POST['product_id'], $item_array_id)){
           // echo "<script>alert('Product is already added in the cart..!')</script>";
           $_SESSION["product-qty"] = $_SESSION["product-qty"]++;
           // echo "<script>window.location = 'product_menu.php'</script>";
        } else{ */

        $count = count($_SESSION['cart']);
        $item_array = array(
                'product_id' => $_POST['product_id']
            );

        $_SESSION['cart'][$count] = $item_array;
    } else {
        $item_array = array(
                'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>

    <!-- Font Roboto -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/hamburger.css">

    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="menu-wrap">
    <input type="checkbox" class="toggler">
    <div class="hamburger"><div></div></div>
    <div class="menu">
      <div>
        <div>
          <ul>  <!-- add pages/ once we clean up the sites directory  -->
            <li><a href="index.php">Home</a></li>
            <li><a href="FAQ.php">FAQ</a></li>
            <li><a href="ContactUs.php">Contact Us</a></li>
	        <li><a href="product_menu.php">Product Menu</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

<div class="container">
        <div class="row text-center py-5">
            <?php
                $result = $database->getData();
                while ($row = mysqli_fetch_assoc($result)) {
                    component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
                }
            ?>
        </div>
</div>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
