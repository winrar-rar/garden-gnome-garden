<?php
	include("headerLogin.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Products</title>
		<link rel="stylesheet" href="products.css" />
	</head>
	<body>
		<h1 id="headline">All Products</h1>
		<article>
			<?php
				require('db.php');

				//10 items will be shown, then a new page will be created with 10 more etc.
				$resultPerPage = 10;

				if (isset($_GET["page"])) {
					$page=$_GET["page"];
				} else {
					$page=1;
				}
				$start_from = ($page - 1) * $resultPerPage;
				
				//Gets the products from database and limits the number of results per page.
				$sql = "SELECT id, product_name, image FROM product LIMIT $start_from, $resultPerPage";
				$result = mysqli_query($connect, $sql);

				while($row = mysqli_fetch_assoc($result)) {
					//echo "<div id='productDiv'><a href='product.php?id={$row['id']}''>{$row['product_name']}</a>"."<br>"."<img id='image_icon' src={$row['image']}></div>";
					echo "<div id='productDiv'><img id='image_icon' src={$row['image']}><a href='product.php?id={$row['id']}''>{$row['product_name']}</a></div>";
				}
				
				//calculates how many pages will be needed.
				$sql2 = "SELECT COUNT(ID) AS total FROM product"; 
				$result2 = mysqli_query($connect, $sql2);
				$row = mysqli_fetch_assoc($result2);
				$total_pages = ceil($row["total"] / $resultPerPage);

				//index for the number of pages.
				echo "<div id='pageDiv'>";
					for ($i=1; $i<=$total_pages; $i++) { 
	    				echo "<a id='pages' href='products.php?page=".$i."'>".$i."</a> "; 
					}; 
				echo "</div>";

				mysqli_close($connect);
			?>
		</article>

	</body>
</html>