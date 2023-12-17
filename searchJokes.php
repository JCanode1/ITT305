<?php
// Include the database connection script (db.php)
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['searchTerm'])) {
    $searchTerm = $_GET['searchTerm'];

    // Search for jokes that match the search term
    $searchQuery = "SELECT JokeText, AnswerText FROM Jokes WHERE JokeText LIKE ? OR AnswerText LIKE ?";
    $stmt = $mysqli->prepare($searchQuery);
    $searchTerm = "%" . $searchTerm . "%"; // Add wildcards for partial matching
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $stmt->bind_result($jokeText, $answerText);

    echo "<h2>Search Results</h2>";

    if ($stmt->fetch()) {
        echo "<table border='1'>";
        echo "<tr><th>Joke</th><th>Answer</th></tr>";
        
        do {
            echo "<tr><td>$jokeText</td><td>$answerText</td></tr>";
        } while ($stmt->fetch());
        
        echo "</table>";
    } else {
        echo "No matching jokes found.";
    }

    $stmt->close();
} else {
    // Redirect to the search form if no search term is provided
    header("Location: searchForm.html"); // Replace with the actual path to your search form
    exit();
}

$mysqli->close();
?>
