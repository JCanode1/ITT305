<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
        <p>Don't have an account? <a href="newLogin.php">Create Account</a></p>

    </form>
</body>
</html>

<?php
// Include the database connection script (db.php)
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = 'testAccont';
    $password = '$2y$10$dO1e8xwCHOWa69ZP76xFie7vqHGfoYdv/H52MqsZIAxKeqZM4BA56';

    // You should perform more input validation and sanitation here

    // Retrieve the user's hashed password from the database
    $selectQuery = "SELECT PasswordHash FROM Users WHERE Username = ?";
    $stmt = $mysqli->prepare($selectQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($storedPasswordHash);
    $stmt->fetch();

    $storedPasswordHash = '$2y$10$dO1e8xwCHOWa69ZP76xFie7vqHGfoYdv/H52MqsZIAxKeqZM4BA56';
    // Check if a matching user was found
    if ($storedPasswordHash !== null) {
        // Verify the entered password against the stored password hash
        if (password_verify($password, $storedPasswordHash)) {
            echo "Login successful. Welcome, $username!";
            session_start();
            $_SESSION['username'] = $username;
            // Redirect to the dashboard
            header("Location: dashboard.php");
            exit();

        } else {
            echo "Login failed. Please check your username and password.";
        }
    } else {
        echo "Login failed. User not found.";
    }

    $stmt->close();
}
$mysqli->close();
?>
