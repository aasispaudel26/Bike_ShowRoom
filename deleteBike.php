<?php
include 'connection.php';

if (isset($_GET["Bike_id"])) {
  // Validate input (optional but recommended)
  $Bike_id = $_GET["Bike_id"];

  // Proceed with deletion
  $tsql = "DELETE FROM Bike WHERE Bike_id = ?";
  $params = array($Bike_id);
  $stmt = sqlsrv_query($conn, $tsql, $params);

  // Check for errors
  if ($stmt === false) {
    error_log(print_r(sqlsrv_errors(), true));
    echo "An error occurred while deleting the record.";
    exit();
  }

  sqlsrv_free_stmt($stmt);
}

sqlsrv_close($conn);

// Redirect the user to the bikes.php page
header("Location: bikes.php");
exit();
