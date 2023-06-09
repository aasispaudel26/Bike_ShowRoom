<?php
include 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$Name =$_POST['Name'];
$Address =$_POST['Address'];
$phoneNumber =$_POST['phoneNumber'];
$Email =$_POST['Email'];
$userName =$_POST['userName'];
$Password =$_POST['Password'];

    $query = "INSERT INTO customers (Name,Address,phoneNumber,Email,userName,Password) 
    VALUES(?, ?, ?, ?, ?, ?)";
    
    $params= array(&$Name,&$Address,&$phoneNumber,&$Email,&$userName,&$Password);
    $stmt = sqlsrv_prepare($conn,$query,$params);
    
    // Execute the statement
    if (sqlsrv_execute($stmt) === false) {
      die(print_r(sqlsrv_errors(), true));
    }

}

?>


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
header {
    background-color: #333;
    color: #fff;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
}

.logo {
    flex: 1;
    
}

.logo img {
    height: 50px;
   
}

nav {
    flex: 2;
}

nav ul {
    display: flex;
    flex-direction: row;
    list-style: none;
    justify-content: flex-end;
}

nav ul li {
    margin: 0 10px;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

li {
  display: inline-block;
  width: 30%;
  text-align: center;
  margin: 20px;
}
nav ul li a {
    color: #fff;
    text-decoration: none;
}
h1 {
    text-align: center;
    margin-bottom: 20px;
}

.intro {
    text-align: center;
}

.intro h1 {
    font-size: 48px;
    margin-bottom: 20px;
}

.intro p {
    font-size: 18px;
    line-height: 1.5;
}


footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
} 


    </style>

</head>

<body>
<header>
    <div class="logo">
      <img src="logo.jpg" alt="Company Logo">
    </div>
    <nav>
      <ul>
      <li><a href="index.html">Home</a></li>
      
                <li><a href="register.php">Bike register</a></li>
                <li><a href="seller.php">Seller</a></li>
                <li><a href="search.php">Search</a></li>
                <li><a href="contactUS.php">Contact Us</a></li>
                <li><a href="aboutUs.html">About Us</a></li>
      </ul>
    </nav>
  </header>
   <center> <h2>
        Welcome to registration
    </h2></center>
    <form action="" method="POST">
    <div class="container">
        
    <form method="post" autocomplete="on">
        <!--First name-->
    		<div class="box">
          <label for="Name" class="fl fontLabel"> Name: </label>
    			<div class="new iconBox">
            <i class="fa fa-user" aria-hidden="true"></i>
          </div>
    			<div class="fr">
    					<input type="text" name="Name" placeholder="Name"
              class="textBox" autofocus="on" required>
    			</div>
    			<div class="clr"></div>
    		</div>
    		<!--First name-->


    		<!--First name-->


        <!--Address-->
    		<div class="box">
          <label for="Address" class="fl fontLabel"> address: </label>
    			<div class="fl iconBox"><i class="fa fa-address-card" aria-hidden="true"></i></div>
    			<div class="fr">
    					<input type="text" required name="Address"
              placeholder="address" id="Address" class="textBox">
    			</div>
    			<div class="clr"></div>
    		</div>
    		<!--Second name-->


    		<!---Phone No.------>
    		<div class="box">
          <label for="phone" class="fl fontLabel"> phoneNumber: </label>
    			<div class="fl iconBox"><i class="fa fa-phone-square" aria-hidden="true"></i></div>
    			<div class="fr">
    					<input type="text" required name="phoneNumber" maxlength="10" id="phoneNumber" placeholder="phoneNumber" class="textBox">
    			</div>
    			<div class="clr"></div>
    		</div>
    		<!---Phone No.---->


    		<!---Email ID---->
    		<div class="box">
          <label for="email" class="fl fontLabel"> Email: </label>
    			<div class="fl iconBox"><i class="fa fa-envelope" aria-hidden="true"></i></div>
    			<div class="fr">
    					<input type="Email" required name="Email"  id="Email" placeholder="Email" class="textBox">
    			</div>
    			<div class="clr"></div>
    		</div>
    		<!--Email ID----->
            <div class="box">
          <label for="username" class="fl fontLabel"> userName: </label>
    			<div class="new iconBox">
            <i class="fa fa-user" aria-hidden="true"></i>
          </div>
    			<div class="fr">
    					<input type="text" name="userName" placeholder=" userName" id="userName"
              class="textBox" autofocus="on" required>
    			</div>
    			<div class="clr"></div>
    		</div>

    		<!---Password------>
    		<div class="box">
          <label for="password" class="fl fontLabel"> Password </label>
    			<div class="fl iconBox"><i class="fa fa-key" aria-hidden="true"></i></div>
    			<div class="fr">
    					<input type="Password" required name="Password" placeholder="Password" class="textBox">
    			</div>
    			<div class="clr"></div>
    		</div><br>
    		<!---Password---->

        
        <!-- <div class="box" style="background: greenyellow"> -->
        <center><input type="submit" onclick="registration()" value="Submit" name ="submit"><br></center>
    </form>
</body>
<script src="script.js"></script>
</html>




