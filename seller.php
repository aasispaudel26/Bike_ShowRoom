<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Seller Page</title>
    <link rel="stylesheet" type="text/css" href="seller.css">
    <script src="script.js"></script>

</head>

<body>
    <?php

    session_start();
    if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
        header("Location:login.php");
    }
    ?>


    <main>
        <h1>Seller Page</h1>
        <p>Welcome to your seller page. here are bikes that can be your dream bike.</p>
        <div id="cars-table-body"></div>
        <?php
        include 'connection.php';
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

    </footer>
</body>

</html>