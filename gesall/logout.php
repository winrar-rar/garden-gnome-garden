<?php
	//This file makes sure that a user can logout. 
	session_start();

	//Destroys sessions and redirect to the login page.
	if(session_destroy()) {
		header("Location: login.php");
	}
?>