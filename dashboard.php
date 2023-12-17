
<?php
// Include the database connection script (db.php)
include 'db.php';

// Start a session to access the username
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Retrieve jokes associated with the logged-in user
    $jokesQuery = "SELECT JokeText, AnswerText FROM Jokes WHERE UserID = (SELECT UserID FROM Users WHERE Username = ?)";
    $stmt = $mysqli->prepare($jokesQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($jokeText, $answerText);

    echo "<h2>Welcome, $username!</h2>";
    echo "<h3>Your Jokes:</h3>";

    echo "<table border='1'>";
    echo "<tr><th>Joke</th><th>Answer</th></tr>";

    while ($stmt->fetch()) {
        echo "<tr><td>$jokeText</td><td>$answerText</td></tr>";
    }

    echo "</table>";

    $stmt->close();
} else {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Joke</title>
</head>
<body>
    <h2>Add a Joke</h2>
    <form action="addJoke.php" method="POST">
        <label for="jokeText">Joke:</label>
        <textarea id="jokeText" name="jokeText" required></textarea><br><br>

        <label for="answerText">Answer:</label>
        <textarea id="answerText" name="answerText" required></textarea><br><br>

        <input type="submit" value="Submit Joke">
    </form>
</body>
</html>


<!DOCTYPE html>
<html>
<head>
    <title>Search Jokes</title>
    <style>
        label {
            display: block; /* This makes the labels appear on separate lines */
            margin-top: 10px; /* Add some spacing between the labels */
        }
    </style>
</head>

<body>
    <h2>Search Jokes from user</h2>
    <form action="searchJokes.php" method="GET">        
        <label for="searchTerm">Search Text:</label>
        <input type="text" id="searchTerm" name="searchTerm" required>
        
        <input type="submit" value="Search">
    </form>
</body>
</html>


