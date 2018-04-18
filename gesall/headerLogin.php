<?php
	session_start();
?>
<!DOCTYPE html>
<html lang ="sv">

	<head>
		<meta charset="utf-8">
		
		<link rel="stylesheet" href="headerLogin.css">
		<link href='//fonts.googleapis.com/css?family=Alex Brush' rel='stylesheet'>
	</head>

	<body>
		<header>
			<img src="Images\GGG.png" alt="Garden Gnome Garden loggo" id="GGG_image" width="" height=""> <p id="GGG_text">Garden Gnome Garden</p>
			
			
			<?php
				//Checking if a user is logged in or not.
				if (isset($_SESSION["username"])) {
					echo "<p id='welcome'>Welcome ". $_SESSION['username']."! <a href='logout.php' id='logout'>Logout</a> </p>";
				}else{
					echo "<p id='logReg'><a href='login.php' id='login'>Login</a>"."<a href='registration.php' id='registration'>Sign up</a> </p>";
					//echo "<a href='register.html' id='register'>Register</a> </p>";
				}
			?>
		</header>

		<ul id="navigation_menu">
			<li><a href="homepage.php">Home</a></li>
			<li><a href="products.php">All Items</a></li>
			<li><a href="about.php">About</a></li>
		</ul>

		<footer>
		</footer>
	</body>
</html>