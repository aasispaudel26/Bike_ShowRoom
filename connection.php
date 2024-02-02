<?php

$serverName = 'AASISPC\SQLEXPRESS02';
$databaseName = 'Bikeshowroom';
// $username = 'your_username'; // Replace with your actual SQL Server username
// $password = 'your_password'; // Replace with your actual SQL Server password

$connectionOptions = [
    "Database" => $databaseName,
    // "Uid" => $username,
    // "PWD" => $password
];

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
