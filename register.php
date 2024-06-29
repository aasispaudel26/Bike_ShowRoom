<?php
include 'connection.php';

// Define variables and initialize with empty values
$Name = $Address = $phoneNumber = $Email = $userName = $Password = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Name = $_POST['Name'];
  $Address = $_POST['Address'];
  $phoneNumber = $_POST['phoneNumber'];
  $Email = $_POST['Email'];
  $userName = $_POST['userName'];
  $Password = $_POST['Password'];

  // Validate and prepare the SQL query
  $query = "INSERT INTO customers (Name, Address, phoneNumber, Email, userName, Password) 
              VALUES (?, ?, ?, ?, ?, ?)";

  $stmt = sqlsrv_prepare($conn, $query, array(&$Name, &$Address, &$phoneNumber, &$Email, &$userName, &$Password));

  // Check if preparation is successful
  if ($stmt === false) {
    echo "Error preparing statement: " . print_r(sqlsrv_errors(), true);
    die();
  }

  // Execute the statement
  if (sqlsrv_execute($stmt) === false) {
    echo "Error executing statement: " . print_r(sqlsrv_errors(), true);
    die();
  }

  echo "Data stored successfully"; // Add this for debugging

  // Registration successful, redirect to login page
  header("location: login.php");
  exit;

  sqlsrv_free_stmt($stmt);
  // sqlsrv_close($conn); // No need to close the connection here
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Showroom</title>
  <link rel="stylesheet" href="stylee.css">
  <script src="script.js"></script>
</head>

<body>

  <div class="wrapper">
    <div class="form-box login">
      <h2>Register</h2>
      <form action="register.php" method="post">

        <div class="input-box">
          <span class="icon"><ion-icon name="person"></ion-icon></span>
          <div class="input-box">
            <span class="icon"><ion-icon name="person"></ion-icon></span>
            <input type="text" id="Name" name="Name" pattern="[A-Za-z]+\s[A-Za-z]+" title="Please enter at least two words (name and surname)" required>
            <label>Name</label>
          </div>

          <label>Name</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="location"></ion-icon></ion-icon></span>
          <input type="text" id="Address" name="Address" pattern="[A-Za-z]+(?:\s[A-Za-z0-9\s]+)?" title="Address must start with alphabet characters only" required>
          <label>Address</label>
        </div>

        <div class="input-box">
          <span class="icon"><ion-icon name="mail"></ion-icon></span>
          <input type="email" id="Email" name="Email" required>
          <label>Email</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="call"></ion-icon></span>
          <input type="tel" id="phoneNumber" name="phoneNumber" pattern="[0-9]{10}" title="Please enter a 10-digit number" required>
          <label>phoneNumber</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="person-circle"></ion-icon></span>
          <input type="text" id="userName" name="userName" pattern="[A-Za-z][A-Za-z0-9]*" title="Username must start with a letter and can contain letters and numbers" required>
          <label>UserName</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" id="Password" name="Password" required>
          <label>Password</label>
        </div>


        <button type="submit" class="btn">Register</button>

      </form>
    </div>
  </div>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>