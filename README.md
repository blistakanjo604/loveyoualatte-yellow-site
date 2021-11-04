# Possible Drink Sizes Implementation

Note: I found this on [stackoverflow](https://stackoverflow.com/questions/39311174/storing-combinations-of-item-properties-in-database) . I already have a database connection set-up and the code is running good for the menu and cart system. This is built on top of the vide branch but we can probably port this over to our old site (master/bootstrap branches).

ITST/Cybersecurity Team: I may need help with this implementation since I am not very good with database relationships.

---
### Start Stack Overflow Comment:

Let try to reason how to solve your task. I will describe  **general conception**  and split it in some steps:

1.  Define  **types of products**  that you are going to sell: cup, plate, pan and so on. Create table  `products`  with fields:  `id, name, price`.
2.  Define  **colours of products**: black, red, brown. Create table  `products_colours`  with fields:  `id, name, price`.
3.  Define  **sizes of products**: small, medium, large. Create table  `products_sizes`  with fields:  `id, name, price`.
4.  In simple case all types of products will have  **the same price**  and will store in table products.
5.  In simple case  **additional price for colours and sizes**  will be  **the same for all types of products**  and will be stored in tables  `products_colours`  and  `products_sizes`.
6.  Create table  `customers_products`  with fields:  `id, products_id, products_colours_id, products_sizes_id, quantity`.
7.  Write a query for join all table together to fetch all products with colours, sizes and all prices from db.
8.  In the script iterates through all rows and calculate  **price**  for every product as a  **sum of product price, size price and colour price**.

To sum up: this is very  **basic implementation**  that doesn't include things like brands, discounts and so on. However, it gives you understanding how to  **scale**  your system in case of adding additional attributes that affect the final price of products.

### End Stack Overflow Comment
---
Post Note: Once we get this implemented we can probably change the html table (add a column) on the code to include a size drop-down and add sql queries to manipulate the sizes and prices of the drink

