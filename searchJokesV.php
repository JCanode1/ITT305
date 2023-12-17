<?php
// Include the database connection script (db.php)
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['searchTerm'])) {
    $searchTerm = $_GET['searchTerm'];

    $sql = "SELECT JokeText, AnswerText FROM Jokes WHERE JokeText LIKE '%$searchTerm%' OR AnswerText LIKE '%$searchTerm%'";
    echo "SQL query: $sql";

    //$sql = "SELECT JokeText, AnswerText FROM Jokes WHERE JokeText LIKE '%test%'; SELECT * FROM Users; -- %' OR AnswerText LIKE '%test%'; Select * from Users; -- %'  ";


    
    if ($mysqli->multi_query($sql)) {
        echo "<h2>Search Results</h2>";
    
        do {
            if ($result = $mysqli->store_result()) {
                if ($result->num_rows > 0) {
                    // Get the column names from the result set
                    $columns = array();
                    while ($column = $result->fetch_field()) {
                        $columns[] = $column->name;
                    }
    
                    // Start building the HTML table
                    echo "<table border='1'><tr>";
    
                    // Create table headers from the column names
                    foreach ($columns as $column) {
                        echo "<th>" . htmlspecialchars($column) . "</th>";
                    }
    
                    echo "</tr>";
    
                    // Fetch and display the data rows
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        foreach ($columns as $column) {
                            echo "<td>" . htmlspecialchars($row[$column]) . "</td>";
                        }
                        echo "</tr>";
                    }
    
                    echo "</table>";
                } else {
                    echo "No matching jokes found.";
                }
    
                $result->free();
            }
        } while ($mysqli->more_results() && $mysqli->next_result());
    } else {
        // Handle any errors that may occur during the query
        echo "Error: " . $mysqli->error;
    }
    

    // Avoid closing the result and the connection to simulate a vulnerable setup
    // $result->close();
    // $mysqli->close();
} else {
    // Redirect to the search form if no search term is provided
    header("Location: searchForm.html"); // Replace with the actual path to your search form
    exit();
}
?>
