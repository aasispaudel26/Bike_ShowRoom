<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Add bike</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="script.js"></script>

	
</head>

<body>

	<?php
	include 'connection.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {


		$query = "INSERT INTO Bike (Brand, color, cc, price, location) VALUES (?, ?, ?, ?, ?)";
		
		$Brand = $_POST["Brand"];
		$color = $_POST["color"];
		$cc = $_POST["cc"];
		$price = $_POST["price"];
		$location = $_POST["location"];
		$sql = "INSERT INTO Bike (Brand, color, cc, price, location) VALUES (?, ?, ?, ?, ?)";
		session_start();
		$id = $_SESSION["bike_id"];
		
		$params= array(&$Brand,&$color,&$cc,&$price,&$location,&$id);
    $stmt = sqlsrv_prepare($conn,$query,$params);
        
	if (sqlsrv_execute($stmt) === false) {
      die(print_r(sqlsrv_errors(), true));
    }
	else {
		// Redirect to seller.php
		header('Location: seller.php');
		exit;
	}
	}	// Attempt to execute the prepared statement
		
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