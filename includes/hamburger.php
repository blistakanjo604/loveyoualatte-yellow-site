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
                      echo '<li><a href="inventory_management.php">Inventory</a></li>';
                      echo '<li><a href="register_employee.php">Register Employee</a></li>';
                      echo '<li><a href="login.php">Log-out</a></li>';
                      echo '<small class="menu-small">User Logged in: ';
                      echo $_SESSION['user'];
                      echo ' ☕ </small>';
                    }
                  elseif($_SESSION['logged']==false)
                    {
                      echo '<li><a href="login.php">Log-in</a></li>';
                    }
                  ?>
            </ul>
         </div>
      </div>
   </div>
</div>
