<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$serverName = "jokesdb-server.mysql.database.azure.com";
$databaseName = "jokes_db";
$username = "ghitbyareg";   
$password = "Password1!";

// Adjust the paths based on the location of your PHP scripts
$sslOptions = array(
    'ssl' => array(
        'cafile' => __DIR__ . '/ca-cert.pem',
        'certfile' => __DIR__ . '/client-cert.pem',
        'keyfile' => __DIR__ . '/client-key.pem',
        'verify_peer' => true,
    ),
);

$conn = new mysqli(
    $serverName,
    $username,
    $password,
    $databaseName,
    3306,
    ...$sslOptions  // Unpack the array using the ... operator
);

echo "Connected successfully";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
