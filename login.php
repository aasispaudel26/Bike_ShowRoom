<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Showroom</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <header>
    <div class="logoo">
      <img src="logooooo-removebg-preview.png" alt="logo" />

    </div>


    <nav class="navigation">
      <a href="index.html">Home</a>
      <a href="seller.php">Buy Bike</a>
      <a href="contactUS.php">Contact US</a>
      <a href="search.php">Search</a>
      <a href="aboutUs.html">About</a>
      <button class="btn"><a href="login.php">login</a></button>
    </nav>
  </header>
  <div class="wrapper">
    <div class="form-box login">
      <h2>Login</h2>
      <form action="login.php" method="post">
        <div class="input-box">
          <span class="icon"><ion-icon name="person-circle"></ion-icon></span>
          <input type="text" id="userName" name="userName" required>
          <label>UserName</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" id="Password" name="Password" required />
          <label>Password</label>
        </div>
        <!-- <div class="remember-forget">
          <label for="isAdmin">Admin Account?</label>
          <input type="checkbox" id="isAdmin" name="isAdmin" value="1" required>
        </div> -->
        <!-- <div class="remember-forget">
          <label><input type="checkbox" />Remember me</label>
          <a href="#">Forget Password?</a>
        </div> -->
        <!-- Display error message if it exists -->
        <?php if (!empty($error_msg)) : ?>
          <div class="error-message"><?php echo $error_msg; ?></div>
        <?php endif; ?>
        <button type="submit" class="btn">Login</button>
        <div class="login-register">
          <p>
            Don't have an account?<a href="register.php" class="register-link">Register</a>
          </p>
        </div>
      </form>
    </div>
  </div>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>


<?php
include 'connection.php';
session_start(); // Start the session

$userName = $Password = "";
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $userName = $_POST['userName'];
  $Password = $_POST['Password'];
  $error_occurred = false; // Flag variable to track if any error occurred

  // Check in the 'customers' table for admin
  $sqlAdmin = "SELECT customer_id, userName, Password FROM customers WHERE userName = ? AND is_admin = 1";
  $paramsAdmin = array(trim($userName));
  $stmtAdmin = sqlsrv_prepare($conn, $sqlAdmin, $paramsAdmin);

  if ($stmtAdmin === false) {
    die(print_r(sqlsrv_errors(), true));
  }

  if (sqlsrv_execute($stmtAdmin)) {
    $rowAdmin = sqlsrv_fetch_array($stmtAdmin, SQLSRV_FETCH_ASSOC);
    if ($rowAdmin) {
      if ($Password == $rowAdmin['Password']) { // Compare plain passwords directly
        // Redirect admin to addBike.php
        $_SESSION["id"] = $rowAdmin["customer_id"];
        $_SESSION["is_admin"] = true;
        header('Location: addBike.php');
        exit;
      } else {
        $error_occurred = true;
        $error_msg = "Incorrect username or password.";
        echo " $error_msg";
      }
    }
  } else {
    die(print_r(sqlsrv_errors(), true));
  }

  // Check in the 'customers' table for regular users if no error occurred yet
  if (!$error_occurred) {
    $sqlCustomer = "SELECT customer_id, userName, Password FROM customers WHERE userName = ? AND (is_admin is null OR is_admin = 0)";
    $paramsCustomer = array(trim($userName));
    $stmtCustomer = sqlsrv_prepare($conn, $sqlCustomer, $paramsCustomer);

    if ($stmtCustomer === false) {
      die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmtCustomer)) {
      $rowCustomer = sqlsrv_fetch_array($stmtCustomer, SQLSRV_FETCH_ASSOC);
      if ($rowCustomer) {
        if ($Password == $rowCustomer['Password']) { // Compare plain passwords directly
          // Redirect regular user to seller.php
          $_SESSION["id"] = $rowCustomer["customer_id"];
          header('Location: seller.php');
          exit;
        } else {
          $error_msg = "Incorrect username or password.";
          echo " $error_msg";
        }
      } else {
        $error_msg = "Incorrect username or password.";
        echo " $error_msg";
      }
    } else {
      die(print_r(sqlsrv_errors(), true));
    }
  }
}
?>