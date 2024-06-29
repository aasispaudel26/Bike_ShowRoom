<?php

include 'connection.php';

session_start();


if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    header("Location: login.php?redirect=seller.php");
    exit;
}

if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: index.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["bike_id"])) {
    $bike_id = $_POST["bike_id"];
    $customer_id = $_SESSION["id"];
    $order_date = date("Y-m-d H:i:s");

    // Check if the bike is already booked
    $check_sql = "SELECT * FROM Orders WHERE bike_id = ?";
    $check_params = array($bike_id);
    $check_stmt = sqlsrv_query($conn, $check_sql, $check_params);

    if ($check_stmt === false) {
        echo "<script>alert('Error checking bike booking: " . print_r(sqlsrv_errors(), true) . "');</script>";
    } else {
        if (sqlsrv_has_rows($check_stmt)) {
            echo "<script>alert('This bike is already booked.');</script>";
        } else {
            // Proceed with booking
            $sql = "INSERT INTO Orders (bike_id, customer_id, Order_date) VALUES (?, ?, ?)";
            $params = array($bike_id, $customer_id, $order_date);

            $stmt = sqlsrv_query($conn, $sql, $params);

            if ($stmt === false) {
                echo "<script>alert('Error: " . print_r(sqlsrv_errors(), true) . "');</script>";
            } else {
                echo "<script>alert('Booked successfully');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Seller Page</title>
    <link rel="stylesheet" href="seller.css">
</head>

<body>
    <header>
        <form method="post">
            <button class="logout-button" type="submit" name="logout">Logout</button>
        </form>
        <div class="welcome-message">
            <center>
                <h2>Welcome!!! Here are bikes that can be your dream bike.</h2>
            </center>
        </div>
    </header>

    <main>
        <div class="bike-container">
            <?php

            $sql = "SELECT * FROM bike";
            $result = sqlsrv_query($conn, $sql);

            if ($result === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            // Display bikes
            if (sqlsrv_has_rows($result)) {
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo "<div class='bike'>";
                    echo "<div class='bike-image'>";
                    echo "<img src='data:image/jpeg;base64," . base64_encode($row["Bike_image"]) . "' alt='Bike Image'>";
                    echo "</div>";
                    echo "<div class='bike-details'>";
                    echo "<p><strong>Brand:</strong> " . $row["Brand"] . "</p>";
                    echo "<p><strong>CC:</strong> " . $row["CC"] . "</p>";
                    echo "<p><strong>Price:</strong> " . $row["Price"] . "</p>";
                    // Form to submit order
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='bike_id' value='" . $row["Bike_id"] . "'>";
                    echo "<button class='order-button' type='submit'>BOOK NOW</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<h3>No bikes listed</h3>";
            }
            ?>
        </div>
    </main>

    <footer>
    </footer>
</body>

</html>