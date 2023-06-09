
<?php

$serverName = 'AASISPC\SQLEXPRESS02';
$databaseName = 'Bikeshowroom';
// $username = $_POST['username'];
// $password = $_POST['password'];

$connection = [
    "Database" => $databaseName
];
$conn = sqlsrv_connect($serverName, $connection);

// if ($conn === false) {
//     die(print_r(sqlsrv_errors(), true));
// } else {
//     echo "Hello world";
// }
