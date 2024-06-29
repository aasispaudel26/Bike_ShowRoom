<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Bike_id = $_POST["Bike_id"];
  $Brand = $_POST["Brand"];
  $cc = $_POST["cc"];
  $price = $_POST["price"];


  if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {

    $imageData = file_get_contents($_FILES["image"]["tmp_name"]);

    if (empty($imageData)) {
      echo "Empty image data.";
      exit;
    }


    $tsql = "UPDATE Bike SET Brand=?, cc=?, price=?, Bike_image=CONVERT(varbinary(max), ?) WHERE Bike_id=?";
    $params = array(&$Brand, &$cc, &$price, &$imageData, &$Bike_id);
  } else {

    $tsql = "UPDATE Bike SET Brand=?, cc=?, price=? WHERE Bike_id=?";
    $params = array(&$Brand, &$cc, &$price, &$Bike_id);
  }


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
