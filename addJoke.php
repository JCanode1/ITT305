<?php
// Include the database connection script (db.php)
include 'db.php';

// Start a session to access the username
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $jokeText = $_POST['jokeText'];
    $answerText = $_POST['answerText'];

    // Insert the new joke into the Jokes table
    $insertQuery = "INSERT INTO Jokes (UserID, JokeText, AnswerText) VALUES ((SELECT UserID FROM Users WHERE Username = ?), ?, ?)";
    $stmt = $mysqli->prepare($insertQuery);
    $stmt->bind_param("sss", $username, $jokeText, $answerText);

    if ($stmt->execute()) {
        echo "Joke added successfully.";
        header("Location: dashboard.php");

    } else {
        echo "Error adding joke: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}

$mysqli->close();
?>
