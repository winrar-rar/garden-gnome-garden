<?php
	//Class that is used to connect to the database. Will be used by other files.
	//Connection details.
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpassword = "";
	$db = "gesall";

	//Make the connection to the database.
	$connect = mysqli_connect($dbhost, $dbuser, $dbpassword, $db);

	//Checks the connection and prints errors.
	if (!$connect) {
		die("Could not connect: ".mysql_error());
	}
?>