<?php
     include 'connection.php';

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Brand = $_POST["Brand"];
        $location = $_POST["location"];
        $query = "SELECT * FROM bike WHERE Brand = ? and location = ?";
        $params= array(&$Brand,&$location);
        $stmt = sqlsrv_prepare($conn,$query,$params);

        if (sqlsrv_execute($stmt) === false) {
          die(print_r(sqlsrv_errors(), true));}
          
        
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
<html>

<head>
  <title>Search Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bike showroom</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <script src="script.js"></script>

</head>
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
  <h1>Search Page</h1>
  <main>
  <div class="container">
    <form method="post">
    <div class="box">
          <label for="Brand" class="fl fontLabel"> Brand: </label>
    			<div class="fl iconBox"><i class="fa fa-motercycle" aria-hidden="true"></i></div>
    			<div class="fr">
    					<input type="text" required name="Brand"
              placeholder="Brand" id="Brand" class="textBox">
    			</div>
    			<div class="clr"></div>
    		</div>
        <div class="box">
          <label for="location" class="fl fontLabel"> location: </label>
    			<div class="fl iconBox"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
    			<div class="fr">
    					<input type="text" required name="location"
              placeholder="location" id="location" class="textBox">
    			</div>
    			<div class="clr"></div>
    		</div><br>
        <!-- <div class="box" style="background: greenyellow"> -->
        <center>
       <button type="submit">Search</button></center>
    </form>
    <br>
    <br>
    <div id="search-results">
     \
    </div>
  </main>
  </body>

</html>