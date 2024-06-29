<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="managebike.css">
  <title>Document</title>
</head>

<body>
  <header>
    <nav class="navigation">
      <a href="addBike.php">Add Bike</a>
      <a href="bikes.php">Managebike</a>
    </nav>
  </header>
  <div class="main-content">
    <?php
    include 'connection.php';

    // Retrieve the bike records from the database
    $tsql = "SELECT Bike_id, Brand, cc, price, Bike_image FROM Bike";
    $stmt = sqlsrv_query($conn, $tsql);
    if ($stmt === false) {
      die(print_r(sqlsrv_errors(), true));
    }

    // Check if there are any bike records
    if (sqlsrv_has_rows($stmt)) {
      // Loop through each bike record
      while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $Bike_id = $row["Bike_id"];
        $Brand = $row["Brand"];
        $CC = $row["cc"];
        $Price = $row["price"];
        $Photo = $row["Bike_image"];

        // Display the bike record
        echo "<div class='bike'>";
        echo "<p>Bike ID: " . $Bike_id . "</p>";
        echo "<p>Brand: " . $Brand . "</p>";
        echo "<p>CC: " . $CC . "</p>";
        echo "<p>Price: " . $Price . "</p>";
        echo "<img class='bike-image' src='data:image/jpeg;base64," . base64_encode($Photo) . "' alt='Bike Photo'>";
        echo "<a href='updateBike.php?Bike_id=" . $Bike_id . "'>Update</a> ";
        echo "<a href='deleteBike.php?Bike_id=" . $Bike_id . "'>Delete</a>";
        echo "</div>";
      }
    } else {
      // Display a message if there are no bike records
      echo "No bike records found.";
    } // Close the statement and connection
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    ?>
  </div>
</body>

</html>