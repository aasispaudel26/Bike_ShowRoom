<?php
include 'connection.php';


if (isset($_GET["Bike_id"])) {
  $Bike_id = $_GET["Bike_id"];


  $tsql = "SELECT Brand, cc, price, Bike_image FROM Bike WHERE Bike_id = ?";
  $params = array($Bike_id);
  $stmt = sqlsrv_query($conn, $tsql, $params);
  if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
  }


  if (sqlsrv_has_rows($stmt)) {

    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $Brand = $row["Brand"];
    $CC = $row["cc"];
    $Price = $row["price"];
    $Photo = $row["Bike_image"];
  } else {

    header("Location: bikes.php");
    exit();
  }


  sqlsrv_free_stmt($stmt);
} else {

  header("Location: bikes.php");
  exit();
}


sqlsrv_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Bike</title>
  <link rel="stylesheet" href="updatebike.css">
</head>

<body>
  <h1>Update Bike</h1>

  <form method="post" action="updateBikeProcess.php" enctype="multipart/form-data">
    <input type="hidden" name="Bike_id" value="<?php echo $Bike_id; ?>">
    <label>Brand:</label>
    <input type="text" name="Brand" value="<?php echo $Brand; ?>"><br>

    <label>CC:</label>
    <input type="text" name="cc" value="<?php echo $CC; ?>"><br>

    <label>Price:</label>
    <input type="text" name="price" value="<?php echo $Price; ?>"><br>

    <label>Current Photo:</label>
    <img src="data:image/jpeg;base64,<?php echo base64_encode($Photo); ?>" alt="Bike Photo"><br>

    <label>New Photo:</label>
    <input type="file" name="image" accept="image/*"><br>

    <button type="submit">Update Bike</button>
  </form>
</body>

</html>