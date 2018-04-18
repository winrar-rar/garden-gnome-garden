<?php
	include("headerLogin.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="login.css" />
	</head>
	<body>
	<?php
	require('db.php');

	// If form submitted, insert values into the database.
	if (isset($_POST['username'])){

		//anti- HTML/XML injection.
		function antiInjection($string)
		{
			    $string = stripslashes($string);
			    $string = strip_tags($string);
			    $string = mysql_real_escape_string($string);
			    return $string;
		}

		$username = antiInjection($_REQUEST['username']);
		$password = antiInjection($_REQUEST['password']);

		//Checking if the user exist in the database or not.
	    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
		$result = mysqli_query($connect,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
	        if($rows==1){
		    	$_SESSION['username'] = $username;
	        	//Redirect user to the homepage.
		    	header("Location: homepage.php");
	         }else{
				echo "<div class='form'>
					<h3>Username/password is incorrect.</h3>
					<br/>Click here to <a href='login.php'>Login</a></div>";
			}
	    }else{
			?>
				<div class="form">
					<h1>Log In</h1>
					<form action="#" method="post" name="loginform">
						<input type="text" name="username" placeholder="Username" required />
						<input type="password" name="password" placeholder="Password" required />
						<input name="submit" type="submit" value="Login" />
					</form>
					<p>Not registered yet? <a href='registration.php'>Register Here</a></p>
				</div>
			<?php } ?>
	</body>
</html>