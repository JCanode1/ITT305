<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$serverName = "jokesdb-server.mysql.database.azure.com";
$databaseName = "jokes_DB";
$username = "ghitbyareg";
$password = "Password1!"; // Replace with your actual database password

// Create connection
$conn = new mysqli($serverName, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// You can use this $conn object for executing SQL queries in your application.

?>
