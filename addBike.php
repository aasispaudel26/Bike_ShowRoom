<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Add bike</title>
	<link rel="stylesheet" type="text/css" href="addbike.css">
	<script src="script.js"></script>


</head>

<body>

	<?php

	include 'connection.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Get the values from the form
		$Brand = $_POST["Brand"];
		$color = $_POST["color"];
		$cc = $_POST["cc"];
		$price = $_POST["price"];
		$location = $_POST["location"];

		// Prepare the SQL query
		$query = "INSERT INTO Bike (Brand, color, cc, price, location) VALUES (?, ?, ?, ?, ?)";
		$params = array(&$Brand, &$color, &$cc, &$price, &$location);

		// Check if the user is logged in and is an admin
		session_start();
		if (!isset($_SESSION["id"]) || !isset($_SESSION["is_admin"]) || $_SESSION["is_admin"] != 1) {
			// Redirect to login page if not logged in or not an admin
			header('Location: login.php');
			exit;
		}

		// Attempt to execute the prepared statement
		$stmt = sqlsrv_prepare($conn, $query, $params);
		if ($stmt === false) {
			die(print_r(sqlsrv_errors(), true));
		}
		if (sqlsrv_execute($stmt)) {
			// Redirect to bikes.php after successful insertion
			header('Location: seller.php');
			exit;
		} else {
			// Display an error message if the query fails
			die(print_r(sqlsrv_errors(), true));
		}
	}
	?>

	<form action="" method="POST">


		<main>
			<h1>Add Bike</h1>
			<form id="add-car-form" method="post">
				<label for="Brand"> Brand *</label>
				<input type="text" id="Brand" name="Brand" required>

				<label for="color">color *</label>
				<input type="text" id="color" name="color" required>

				<label for="cc">cc *</label>
				<input type="text" id="cc" name="cc" required>

				<label for="price">Price *</label>
				<input type="text" id="price" name="price" required>


				<label for="location">Location *</label>
				<input type="text" id="location" name="location" required>

				<button type="submit">Add Bike</button>
				<!-- <input type="submit" class="button">Add Bike</button> -->
			</form>
		</main>
</body>

</html>