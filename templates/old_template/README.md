# loveyoualatte-yellow-site

The connetion information is on the CreateDB.php file chagne this so that it can connect to our MySQL DB
This branch is here to test if we can get the connection from the db to .shopping_cart.php to work. 
The cart is desing to fetch the data for the products from the db instead of hard coding it into the site.
Before you start you need to create the tables below follow these instuctions. 
If you are unsure what directorty you should place the images in please follow the instructions bellow. 
The 3 php files that we are test should be placed in the PHP folder inside of pages the path should be "/var/www/html/pages/php"
They are as follows CreateDB.php, component.php, and header.php






Run this command first						CREATE TABLE Productdb
                            (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                             product_name VARCHAR (25) NOT NULL,
                             product_price FLOAT,
                             product_image VARCHAR (100)
                            );
                            
						The above command is going to create the table "Productdb" with the listed columns and their data types

Don't run this SQL command until you have the images in the img folder in the pages folder the path should look like this” \pages\img”.  						 

INSERT INTO Productdb (product_name, product_price, product_image)
        VALUES ('Cappuccino',9.99,'./img/cappuccino.jpeg'),
                        ('Drip Coffee',5.99,'./img/drip_cof.jpeg'),
                        ('Latte',7.99,'./img/lattea.jpeg'),
                        ('Espresso',4.99,'./img/espresso.jpeg'),
                         ('Macchiato',6.99,'./img/macchiato.jpeg'),
                          ('Mocha',8.99,'./img/mocha.jpeg');
						  
						  
							
					We need to clean up the directory for a the site a little bite change the links to wahts below and place the files in the dirotory listed below		
                 updated links Need to change for every page on the site
							  <li><a href="index.php">Home</a></li>
            <li><a href="pages/FAQ.php">FAQ</a></li>
            <li><a href="pages/ContactUs.php">Contact Us</a></li>
	        <li><a href="pages/products.php">Product Menu</a></li>
            <li><a href="pages/form.php">Sign-up (Old Website)</a></li>
            <li><a href="pages/shopping_cart.php">shopping cart</a></li>
            
            
