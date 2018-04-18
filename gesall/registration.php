<?php
	include("headerLogin.php");
?>
<!DOCTYPE html>
<html lang ="sv">

	<head>
		<title>Registration</title>
		<meta charset="utf-8">

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
		<script type="text/javascript" src="registration.js"></script>

		<link rel="stylesheet" href="registration.css">

	</head>

	<body>
		<form action="submit.php" method="POST">
			<div id="f_container">
				<label>First Name:</label>
				<input type="text" name="fname" required class="alpha input"><br>
				<label>Last Name:</label>
				<input type="text" name="lname" required class="alpha input" ><br>
				<label>Username:</label>
				<input type="text" name="username" required class="alphaNum input"><br>
				<label>Password:</label>
				<input type="text" name="password" required id="password" class="alphaNum input" pattern=".{6,}"><br>
				<label>Repeat Password:</label>
				<input type="text" name="repeat_password" id="repeat_password" class="alphaNum input"><br>
				<label>e-mail:</label>
				<input type="text" name="email" required class="input"><br>

				<input type="submit" value="Submit" id="submitB" onclick="return Validate();">
			</div>
			
		</form>
	</body>
</html>