<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Brand = $_POST["Brand"];
  $cc = $_POST["cc"];

  // Modify the query to filter by Brand and cc
  $query = "SELECT * FROM bike WHERE Brand LIKE ? AND cc LIKE ?";
  $params = array("%$Brand%", "%$cc%");
  $stmt = sqlsrv_prepare($conn, $query, $params);

  if (sqlsrv_execute($stmt) === false) {
    die(print_r(sqlsrv_errors(), true));
  }

  if (sqlsrv_has_rows($stmt)) {
    echo "<h3>Matching bike</h3>";
    echo "<div class='wrapper'>";
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
      echo "<div class='bike-container left'>";
      echo "<img class='bike-image' src='data:image/jpeg;base64," . base64_encode($row["Bike_image"]) . "' alt='Bike Image'>";
      echo "<div class='bike-details'>";
      echo "<p><strong>Brand:</strong> " . (isset($row["Brand"]) ? $row["Brand"] : "N/A") . "</p>";
      echo "<p><strong>CC:</strong> " . (isset($row["CC"]) ? $row["CC"] : "N/A") . "</p>";
      echo "<p><strong>Price:</strong> " . (isset($row["Price"]) ? $row["Price"] : "N/A") . "</p>";
      echo "<button class='order-button' onclick='bookNow ()'>BOOK NOW</button>";
      echo "</div>";
      echo "</div>";
    }
    echo "</div>";
  } else {
    echo "<h3>No matching bikes</h3>";
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

  <script>
    function validateForm() {
      var brand = document.getElementById("Brand").value;
      var cc = document.getElementById("cc").value;

      if (brand.trim() === "" && cc.trim() === "") {
        alert("Please enter at least one search criteria.");
        return false;
      }
    }

    function bookNow() {
      var isLoggedIn = false;
      if (!isLoggedIn) {
        alert("Please log in first to place an order.");
        return false; // Prevent form submission
      }
    }
  </script>
</head>

<body>
  <header>
    <div class="logoo">
      <img src="logooooo-removebg-preview.png" alt="logo" />
      <center>

      </center>
    </div>

    <nav class="navigation">
      <a href="index.html">Home</a>
      <a href="seller.php">Buy Bike</a>
      <a href="contactUS.php">Contact</a>
      <a href="search.php">Search</a>
      <a href="aboutUs.html">About US</a>
      <button class="btn"><a href="login.php">Login</a></button>
    </nav>
  </header>
  <div class="wrapper">
    <div class="form-box login">
      <h2>Search Bike</h2>
      <form action="search.php" method="post" onsubmit="return validateForm()">
        <div class="input-box">
          <span class="icon"><ion-icon name="bicycle"></ion-icon></span>
          <input type="text" id="Brand" name="Brand">
          <label>Brand</label>
        </div>

        <div class="input-box">
          <span class="icon"><ion-icon name="speedometer"></ion-icon></span>
          <input type="text" id="cc" name="cc">
          <label>CC</label>
        </div>

        <button type="submit" class="btn">Search</button>
      </form>
    </div>
  </div>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>