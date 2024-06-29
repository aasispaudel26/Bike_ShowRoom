<?php
include 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Name = $_POST['Name'];
  $Email = $_POST['Email'];
  $Message = $_POST['Message'];



  $query = "INSERT INTO contactUs
      (Name,
        Email,
        Message
      ) VALUES (
          ?,
          ?, 
          ?
           )";



  $params = array(&$Name, &$Email, &$Message);

  $stmt = sqlsrv_prepare($conn, $query, $params);


  if (sqlsrv_execute($stmt) === false) {
    die(print_r(sqlsrv_errors(), true));
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css" />
  <script src="script.js"></script>

</head>

<body>
  <header>
    <div class="logoo">
      <img src="logooooo-removebg-preview.png" alt="logo" />

    </div>


    <nav class="navigation">
      <a href="index.html">Home</a>
      <a href="seller.php">Buy Bike</a>
      <a href="contactUS.php">Contact Us</a>
      <a href="search.php">Search</a>
      <a href="aboutUs.html">About US</a>
      <button class="btn"><a href="login.php">login</a></button>
    </nav>
  </header>

  <div class="container border mt-3 bg-light">
    <div class="row">
      <div class="col-md-6 p-5 bg-primary text-white">
        <h1>HI THere</h1>
        <h4>
          If you have any query or message you can send message to us! <br />
          Thank you!
        </h4>
      </div>

      <div class="col-md-6 py-3" style="background-color: aqua">
        <center>
          <h1>Contact US</h1>
        </center>
        <form action="" method="post">
          <div class="form-group">
            <h5 for="name">Name</h5>
            <input type="text " id="Name" name="Name" required class="form-control" placeholder="Enter your name" />
          </div>

          <div class="form-group">
            <h5 for="email">Email</h5>
            <input type="email" id="Email" name="Email" required class="form-control" id="Email" placeholder="Enter your email" />
          </div>

          <div class="form-group">
            <h5 for="message">Message</h5>
            <textarea id="Message" id="Message" name="Message" required rows="3" class="form-control"></textarea>
          </div>
          <button class="btn btn-primary" onclick="sendMail()">Send</button>
      </div>
    </div>
  </div>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>