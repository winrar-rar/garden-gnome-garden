<?php
	require("db.php");

	//anti- HTML/XML injection.
	function antiInjection($string)
	{
	    $string = stripslashes($string);
	    $string = strip_tags($string);
	    $string = mysql_real_escape_string($string);
	    return $string;
	}

	//data from register.html-form.
	$fname = antiInjection($_POST["fname"]);
	$lname = antiInjection($_POST["lname"]);
	$username = antiInjection($_POST["username"]);
	$password = antiInjection($_POST["password"]);
	$email = antiInjection($_POST["email"]);


	$sqlCheckUser = "SELECT username, email FROM users WHERE username='$username' OR email='$email'";
	$resultExist = mysqli_query($connect, $sqlCheckUser) or die(mysqli_error($connect));;

	//check if email/username exist
	if(mysqli_num_rows($resultExist) > 0) {
		//not working correctly.
		// $_SESSION['exist'] = "Username/Email is already in use";
		
		//redirect to info-page.
		header("Location: userexist.php");
	} else {

		//insert data into the database.
		$sql = 'INSERT INTO users'. "(username, password, first_name, last_name, email)".
			"VALUES ('$username', '$password', '$fname', '$lname', '$email')";

		mysql_select_db($db);

		//return value
		$return = mysqli_query($connect, $sql);

		//informs the user if data could not be entered.
		if (!$return) {
			die("Could not enter data: ". mysql_error());
		}

		echo "Entered data successfully\n";
		header("Location: login.php");

	}

	mysqli_close($connect);

?>