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
	$username = antiInjection($_POST["username"]);
	$date = antiInjection($_POST["date"]);
	$comment = antiInjection($_POST["comment"]);
	$pid = antiInjection($_POST["id"]);

	//Check if the pid actually exist.
	$sql = "SELECT id FROM product WHERE id='$pid'";
	$resultExist = mysqli_query($connect, $sql) or die($connect);


	//insert data into the database.
	if($comment != '' && mysqli_num_rows($resultExist) > 0) {
		$sql = 'INSERT INTO comments'. "(username, date, comment, product_id)".
			"VALUES ('$username', '$date', '$comment', '$pid')";


		mysql_select_db($db);

		//result
		$result = mysqli_query($connect, $sql);

		//informs the user if data could not be entered.
		if (!$result) {
			die("Could not enter data: ". mysql_error());
		}

		//echo "Entered data successfully\n";
		header("Location: product.php?id=$pid");


	} else {
		header("Location: product.php?id=$pid");
	}

	mysqli_close($connect);

?>