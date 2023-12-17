<?php

$serverName = "jokesdb-server.mysql.database.azure.com";
$databaseName = "jokes_DB";
$username = "ghitbyareg";
$password = "your_password"; // Replace with your actual database password

// Create connection
$conn = new mysqli($serverName, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// You can use this $conn object for executing SQL queries in your application.

?>
