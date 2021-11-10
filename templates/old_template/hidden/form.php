<!DOCTYPE html>
 <html>
   <head>

	 <title>Love You A Latte (CapStone Team Yellow)</title>


	 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	 <script src="../_js/jquery.min.js"></script>
	 <script src="../_js/jquery-ui.min.js"></script>
     <script src="external/jquery/jquery.js"></script>
	 <script src ="js/jquery-ui.min.js"></script>
	 <link href="css/headerFont.css" rel="stylesheet">
	 <script>
    /* $(document).ready(function(){
		 customerName = prompt("What is your name? ")
		 customerGreet = alert("Hello "+customerName+" !")
     })

	*/</script>

    </head>
	<body>

	<div id="cen">
		<header>
			<h1>Love You A Latte </h1>
		</header>

		<h2>Please leave your First and last name , as well as your contact information</h2>
			<form  action="signup.php" method="POST">
				<label for="first">First name</label>
				<input type="text" id="first" name="first"><br><br>
				<label for="last">Last name</label>
				<input type="text" id="last" name="last"><br><br>
				<label for="phone">Phone number</label><br>
				<input type="tel" id="phone" name="phone" placeholder="555-555-555">
				<label for="email">Email:</label>
				<input type="email" id="email" name="email" placeholder="youremail@domainame.com">
				<input type="submit" value="Save"> <input type="reset" value="Reset">
				<button type="submit" name="submit">Click Here</button>

				<p id="time"></p>
			</form>
			<a href="pages/FAQ.php">FAQ</a>
			<a href="http://147.182.209.250/">Home</a>
			<a href="pages/ContactUs.php">Contact Us</a>

			<p id="time"></p>

        Hello <?php echo$_POST["name"]; ?>

	<footer>
		<h4>Team Yellow 2021</h4>
	</footer>
	</div>
	</body>
<script>
	alert("Hello World")
</script>
</html>
