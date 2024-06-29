<?php
include 'connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!isset($_FILES["image"]) || $_FILES["image"]["error"] != UPLOAD_ERR_OK) {
		echo "Upload Error: " . $_FILES["image"]["error"];
		exit;
	}

	$Brand = $_POST["Brand"];
	$cc = $_POST["cc"];
	$price = $_POST["price"];
	$imageData = file_get_contents($_FILES["image"]["tmp_name"]);

	if (empty($imageData)) {
		echo "Empty image data.";
		exit;
	}

	// Check if the user is authenticated as an admin
	if (!isset($_SESSION["id"]) || !isset($_SESSION["is_admin"]) || $_SESSION["is_admin"] != 1) {
		// Unset all session variables
		session_unset();

		// Destroy the session
		session_destroy();

		// Redirect to the login page after logout
		header("Location: login.php");
		exit;
	}

	// Proceed with inserting the bike record
	$tsql = "INSERT INTO Bike (Brand, cc, price, Bike_image) VALUES (?, ?, ?, CONVERT(varbinary(max), ?))";
	$params = array($Brand, $cc, $price, $imageData);

	$stmt = sqlsrv_prepare($conn, $tsql, $params);
	if ($stmt === false) {
		die(print_r(sqlsrv_errors(), true));
	}
	if (sqlsrv_execute($stmt)) {
		header('Location: bikes.php');
		exit;
	} else {
		die(print_r(sqlsrv_errors(), true));
	}

	sqlsrv_free_stmt($stmt);
	sqlsrv_close($conn);
}
?>







<!DOCTYPE html>
<html>

<head>
	<title>Add Bike</title>
	<link rel="stylesheet" href="addbike.css">
</head>

<body>
	<header>
		<nav class="navigation">
			<a href="addBike.php">Add Bike</a>
			<a href="bikes.php">Managebike</a>
			<a href="#" onclick="logout()">Logout</a>
		</nav>
	</header>
	<script>
		function logout() {
			// Send an AJAX request to a PHP script to handle the logout
			var xhr = new XMLHttpRequest();
			xhr.open("GET", "logout.php", true);
			xhr.onload = function() {
				// Redirect to the login page after logout
				window.location.href = "login.php";
			};
			xhr.send();
		}
	</script>

	<main>
		<h1>Add Bike</h1>
		<form id="add-bike-form" method="post" action="addBike.php" enctype="multipart/form-data">
			<label for="Brand">Brand *</label>
			<input type="text" id="Brand" name="Brand" required>

			<label for="cc">CC *</label>
			<input type="text" id="cc" name="cc" required>

			<label for="price">Price *</label>
			<input type="text" id="price" name="price" required>

			<label for="image">Image *</label>
			<input type="file" id="image" name="image" accept="image/*" required>

			<button type="submit">Add Bike</button>
		</form>
	</main>
</body>

</html>