<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href = "styles/style.css">
	<title>Fuck the C Store</title>
</head>
<body id="images">

	<?php include 'includes/header.php';?>

	<table>
		<tr>
				<th>Author</th>
				<th>Title</th>
				<th>Edition</th>
				<th>Price</th>
				<th>Email</th>
		</tr>


		<?php
			require_once 'includes/config.php';
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			// valid album_id, print the images
			$result = $mysqli->query("SELECT * FROM books WHERE active_listing=1 ORDER BY author");
			
			while ($row = $result->fetch_assoc()) {
				print("<tr>");

					print("<td>" . $row["author"] . "</td>");
					print("<td>" . $row["title"] . "</td>");
					print("<td>" . $row["edition"] . "</td>");
					print("<td>" . $row["price"] . "</td>");
					print("<td>" . $row["email"] . "</td>");
				
				print("</tr>");	
			}
		?>  

	</table>
</body>
</html>