<?php

$serverName = "jokesdb-server.mysql.database.azure.com";
$databaseName = "jokes_DB";
$username = "ghitbyareg";
$password = "your_password"; // Replace with your actual database password

// Create connection
$conn = new mysqli($serverName, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database
$sql = "CREATE DATABASE IF NOT EXISTS $databaseName";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db($databaseName);

// Create the Users table
$sql = "CREATE TABLE IF NOT EXISTS Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL UNIQUE,
    PasswordHash VARCHAR(255) NOT NULL,
    google2fa_secret VARCHAR(255),
    is_2fa_enabled TINYINT(1) DEFAULT 0
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Users created successfully";
} else {
    echo "Error creating table Users: " . $conn->error;
}

// Create the Jokes table
$sql = "CREATE TABLE IF NOT EXISTS Jokes (
    JokeID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    JokeText TEXT NOT NULL,
    AnswerText TEXT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Jokes created successfully";
} else {
    echo "Error creating table Jokes: " . $conn->error;
}

// Close the connection
$conn->close();

?>
