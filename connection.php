<?php

$serverName = 'AASISPC\SQLEXPRESS02';
$databaseName = 'Bikeshowroom';


$connectionOptions = [
    "Database" => $databaseName,
];

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
