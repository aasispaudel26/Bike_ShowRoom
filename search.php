<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Brand = $_POST["Brand"];
  $location = $_POST["location"];
  $query = "SELECT * FROM bike WHERE Brand = ? and location = ?";
  $params = array(&$Brand, &$location);
  $stmt = sqlsrv_prepare($conn, $query, $params);

  if (sqlsrv_execute($stmt) === false) {
    die(print_r(sqlsrv_errors(), true));
  }


  if (sqlsrv_has_rows($stmt)) {
    echo "<h3>Matching bike</h3>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Brand</th>";
    echo "<th>color</th>";
    echo "<th>cc</th>";
    echo "<th>Price</th>";
    echo "<th>Location</th>";
    echo "</tr>";

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
      echo "<tr>";
      echo "<td>" . $row["Brand"] . "</td>";
      echo "<td>" . $row["color"] . "</td>";
      echo "<td>" . $row["cc"] . "</td>";
      echo "<td>" . $row["price"] . "</td>";
      echo "<td>" . $row["location"] . "</td>";
      echo "</tr>";
    }

    echo "</table>";
  } else {
    echo "<h3>No bike Listed</h3>";
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Showroom</title>
  <link rel="stylesheet" href="search.css" />
</head>

<body>
  <header>
    <div class="logoo">
      <img src="logooooo-removebg-preview.png" alt="logo" />
      <center>
        <h2 class="logo">AaSis</h2>
      </center>
    </div>
    <!-- <h2 class="logo">AaSis</h2> -->

    <nav class="navigation">
      <a href="index.html">Home</a>
      <a href="seller.php">Seller</a>
      <a href="contactUS.php">Contact</a>
      <a href="search.php">Search</a>
      <a href="aboutUs.html">About</a>
      <button class="btn"><a href="login.php">login</a></button>
    </nav>

  </header>
  <div class="wrapper">
    <div class="form-box login">
      <h2>Search Bike</h2>
      <form action="search.php" method="post">
        <div class="input-box">
          <span class="icon"><ion-icon name="bicycle"></ion-icon></span>
          <input type="text" id="Brand" name="Brand">
          <label>Brand</label>
        </div>


        <div class="input-box">
          <span class="icon"><ion-icon name="location"></ion-icon></ion-icon></span>
          <input type="text" id="location" name="location">
          <label>Location</label>
        </div>

        <button type="submit" class="btn">Search</button>


      </form>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>