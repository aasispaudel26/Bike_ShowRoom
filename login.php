<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
<style>
        *{
	padding: 0;
	margin: 0;
}
body{
  background-color: #ff6600;
  background-position: 0vmin;
  background-size: cover;
}
h2{
	transform-style: preserve-3d;
}

.container{
	background: darkgreen;
	width: 350px;
	height: 400px;
	padding-bottom: 20px;
	position: absolute;
	top:50%;
	left: 50%;
	transform: translate(-50%, -50%);
	margin: auto;
  padding: 70px 50px 20px 50px;
}


.fl{
	float: left;
  width: 110px;
  line-height: 35px;
}

.fontLabel{
  color: white;
}

.fr{
	float: right;
}

.clr{
	clear: both;
}

.box{
	width: 360px;
	height: 35px;
	margin-top: 10px;
	font-family: verdana;
	font-size: 12px;
}

.textBox{
	height: 35px;
	width: 190px;
	border: none;
  padding-left: 20px;
}

.new{
  float: left;
}

.iconBox{
	height: 35px;
	width: 40px;
	line-height: 38px;
	text-align: center;
  background: #ff6600;
}

.radio{
	color: white;
	background: #2d3e3f;
	line-height: 38px;
}

.terms{
	line-height: 35px;
	text-align: center;
	background: #2d3e3f;
	color: white;
}

.submit{
	float: right;
	border: none;
	color: blue;
	width: 110px;
	height: 35px;
	background: #ff6600;
	text-transform: uppercase;
  cursor: pointer;
}
    </style>
</head>

<body>
    <center>
    <h2>
        Welcome to Login
    </h2>
    </center>
    <div class="container">
<form method='POST' action="login.php">

    
<div class="box">
          <label for="username" class="fl fontLabel"> username: </label>
    			<div class="new iconBox">
            <i class="fa fa-user" aria-hidden="true"></i>
          </div>
    			<div class="fr">
    					<input type="text" name="username" placeholder="username"
              class="textBox" autofocus="on" required>
    			</div><br><br>
                <div class="clr"></div>
                </div>

                <div class="box">
          <label for="password" class="fl fontLabel"> Password </label>
    			<div class="fl iconBox"><i class="fa fa-key" aria-hidden="true"></i></div>
    			<div class="fr">
    					<input type="Password" required name="password" placeholder="Password" class="textBox">
    			</div>
    			<div class="clr"></div>
    		</div><br>
            <!-- <div class="box" style="background: greenyellow"> -->
    <center><input type="submit" onclick="login()" value="Submit" name ="submit"><br>
    </div></form>
    </center>
</body>
<script src="script.js"></script>

</html>

      



<?php
 include 'connection.php';

$username = $password = "";
$username_err = $user_password_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty(trim($_POST['username']))) {
      $username_err = "please enter a username";
  } else if (empty(trim($_POST['password']))) {
      $user_password_err = "please enter a password";
  } else if (strlen(trim($_POST["password"])) < 6) {
      $user_password_err = "password must be at least 6 characters long";
  } else {
      $sql = "SELECT * FROM seller WHERE username = ? AND password = ?";
      $params = array(trim($_POST["username"]), trim($_POST["password"]));
      $stmt = sqlsrv_query($conn, $sql, $params);

      if ($stmt === false) {
          die(print_r(sqlsrv_errors(), true));
      }

      $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

      if ($row) {
          session_start();
          $_SESSION["id"] = $row["user_id"];
          header('Location: seller.php');
          exit;
      } else {
          $username = trim($_POST["username"]);
      }

      sqlsrv_free_stmt($stmt);
  }

}

?>