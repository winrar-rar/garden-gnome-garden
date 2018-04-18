<?php
	include("headerLogin.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="product.css" />

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
		<script type="text/javascript" src="comments.js"></script>
	</head>
	<body>
		<article>
			<?php
				require('db.php');

					//anti- HTML/XML injection.
					function antiInjection($string)
					{
					    $string = stripslashes($string);
					    $string = strip_tags($string);
					    $string = mysql_real_escape_string($string);
					    return $string;
					}

				$product_id = antiInjection($_GET["id"]);
				$currency = "$";

				//check if the id is numeric, otherwise cast default no such product.
				if(is_numeric($product_id)){
					//get the product where id match.
					$sql = "SELECT product_name, price, description, image FROM product WHERE id=$product_id";
				

					$result = mysqli_query($connect, $sql);
			   	
			   		//if product exist show info.
					if(mysqli_num_rows($result)>0 ) {
					  	while($row = mysqli_fetch_assoc($result)) {
					   		echo "<img id='image_icon' src='{$row['image']}'>";
					      	echo "<div id='productDiv'> 
					      <p>{$row['product_name']}</p>
					      <p>Price: {$row['price']}$currency</p> <br>".
					   		"{$row['description']} <br> </div>";
					   	}
					} else {
						echo "<div class='productNotExist'>The product you are looking for does not exist.</div>";
					}
				}

			?>
		</article>
		
		<aside>
			<div id="comment_container">
				
				<?php

					if(is_numeric($product_id)){
						$c_date = date("Y-m-d");
						//if the usre is logged in, the user is able to comment.
						if(mysqli_num_rows($result)>0) {

							echo "<h2 id='headline'>Comments</h2>";

							if (isset($_SESSION["username"])) {
								//echo "<p>Welcome ". $_SESSION['username']."! <a href='logout.php'>Logout</a> </p>";
								echo "<p id='makeComment'>Make a comment</p>";
								echo "<div id='commentDiv'>
									<form action='submitComment.php' method='POST'>
										<textarea id='commentArea' name='comment' rows='15em' cols='79em'></textarea><br>
										<input type='hidden' name='date' class='hidden' value=$c_date required>
										<input type='hidden' name='id' class='hidden' value=$product_id required>
										<input type='hidden' name='username' class='hidden' value=$_SESSION[username] required>
										<input type='submit' value='Submit'>
									</form>
								</div>";
								//if the user is not logged in the user has the possibility to do so.
							}else{
								echo "<p>You must be logged in to comment.</p> <br>";
								echo "<p id='login'><a href='login.php'>Login.</a> </p>";
							}


							//get the comments
							$sqlComments = "SELECT username, date, comment FROM comments WHERE product_id=$product_id";
							$resultComments = mysqli_query($connect, $sqlComments);

							//show all comments for a product.
							if(mysqli_num_rows($resultComments)>0) {	
							  	while($row = mysqli_fetch_assoc($resultComments)) {
										
									echo "<div id='comments'>
								    {$row['date']} Comment by: <b>{$row['username']}</b> <br>".
								   	"{$row['comment']} <br> </div>";
							  		
							   	}

							//if there is no comments.
							} else if (mysqli_num_rows($resultComments)<=0) {
								echo "There are no comments yet. Be the first to leave a reply";
							}
						}

						//close connection
						mysqli_close($connect);
					}
					else {
						echo "<div class='productNotExist'>The product you are looking for does not exist.</div>";
					}
				?>
			</div>

		</aside>
	</body>
</html>