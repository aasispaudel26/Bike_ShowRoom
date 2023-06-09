<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Seller Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="main.js"></script>

</head>

<body>
    <?php

    session_start();
    if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {header("Location:login.php");
    }
    ?>
    <header>
        <nav>
            <ul>
                <li><a href="./index.html">Seller Home</a></li>
                <li id="add-bike-link"><a href="addBike.php">Add bike</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Seller Page</h1>
        <p>Welcome to your seller page. Here you can manage your Bike  advertisements.</p>
        <div id="cars-table-body"></div>
        <?php
           include'connection.php';
            $sql = "SELECT * FROM bike";

            $result = sqlsrv_query($conn, $sql);

            if ($result === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            
            if (sqlsrv_has_rows($result)) {
                echo "<h3>Currently Listed bike</h3>";
                echo "<table>";
                echo "<tr>";
                echo "<th>Brand</th>";
                echo "<th>color</th>";
                echo "<th>cc</th>";
                echo "<th>Price</th>";
                echo "<th>Location</th>";
                echo "</tr>";
            
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
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
        ?>
    </main>

    <footer>
        <p>&copy; 2023 Online Car Sale</p>
    </footer>
</body>

</html>